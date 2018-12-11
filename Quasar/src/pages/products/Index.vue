<template>
    <div class="q-my-xl">
        <q-table
                :data="serverData"
                :columns="columns"
                row-key="id"
                title="List of products"
        >
            <q-tr slot="body" slot-scope="props" :props="props">
                <q-td key="id" :props="props">
                    <span>{{ props.row.id }}</span>
                </q-td>
                <q-td key="artist_name" :props="props">
                    <span>{{ props.row.artist_name }}</span>
                </q-td>
                <q-td key="album_name" :props="props">
                    <span>{{ props.row.album_name }}</span>
                </q-td>
                <q-td key="type" :props="props">
                    <span>{{ props.row.type }}</span>
                </q-td>
                <q-td class="text-right">
                    <div v-if="props.row.id == 'DELETED'">DELETED</div>
                    <div v-else>
                        <q-btn round icon="edit" class="q-mr-xs" @click="$router.push('/products/' + props.row.id + '/edit')" />
                        <q-btn round icon="delete" @click="destroy(props.row.id , props.row.artist_name , props.row.__index)"/>
                    </div>
                </q-td>
            </q-tr>
        </q-table>
    </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      columns: [
        { name: 'id', label: 'ID', field: 'id', sortable: false, align: 'left' },
        { name: 'artist_name', label: 'Artist Name', field: 'artist_name', sortable: true, align: 'left' },
        { name: 'album_name', label: 'Album Name', field: 'album_name', sortable: true, align: 'left' },
        { name: 'type', label: 'Type', field: 'type', sortable: true, align: 'left' },
        { name: 'actions', label: 'Actions', sortable: false, align: 'right' }
      ],
      selected: [],
      loading: false,
      serverPagination: {
        page: 1,
        rowsNumber: 50, // the number of total rows in DB
        rowsPerPage: 50,
        sortBy: 'artist_name',
        descending: true
      },
      serverData: []
    }
  },
  methods: {
    request ({ pagination }) {
      // QTable to "loading" state
      this.loading = true
      // fetch data
      axios
        .get(`http://localhost/products/list/${pagination.page}?sortBy=${pagination.sortBy}&descending=${pagination.descending}`)
        .then(({ data }) => {
          console.log(pagination.page)
          console.log(pagination.rowsPerPage)
          console.log(pagination.sortBy)
          console.log(pagination.descending)
          // console.log(data)
          // updating pagination to reflect in the UI
          this.serverPagination = pagination

          // we also set (or update) rowsNumber
          this.serverPagination.rowsNumber = data.rowsNumber

          // then we update the rows with the fetched ones
          this.serverData = data.rows

          // finally we tell QTable to exit the "loading" state
          this.loading = false
        })
        .catch(error => {
          // there's an error... do SOMETHING
          this.$q.notify({type: 'negative', timeout: 2000, message: 'Chyba na strane servera'})
          console.log(error)

          // we tell QTable to exit the "loading" state
          this.loading = false
        })
    },
    destroy (id, name, rowIndex) {
      console.log(id)
      console.log(name)
      console.log(rowIndex)
      this.$q.dialog({
        title: 'Delete',
        message: 'Are you sure to delete ' + name + '?',
        color: 'primary',
        ok: true,
        cancel: true
      }).then(() => {
        axios
          .delete(`http://localhost/products/${id}`)
          .then((response) => {
            this.serverData[rowIndex].id = 'DELETED'
            if (response.data.status === 'success') {
              this.$q.notify({type: 'positive', timeout: 2000, message: response.data.msg})
            } else {
              this.$q.notify({type: 'negative', timeout: 2000, message: response.data.msg})
            }
          })
          .catch(error => {
            this.$q.notify({type: 'negative', timeout: 2000, message: 'Chyba na strane servera'})
            console.log(error)
          })
      }).catch(() => {

      })
    }
  },
  mounted () {
    // once mounted, we need to trigger the initial server data fetch
    this.request({
      pagination: this.serverPagination,
      filter: this.filter
    })
  }
}
</script>
