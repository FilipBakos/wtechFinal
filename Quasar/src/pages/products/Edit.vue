<template>
    <div class="q-my-xl">
        <q-card>
            <q-card-title>Edit {{ artistName }}</q-card-title>
            <q-card-main>
                <q-field :count="250">
                    <q-input float-label="Artist name" v-model="artistName" max-length="250" />
                </q-field>
                <q-field :count="250">
                    <q-input float-label="Album name" v-model="albumName" max-length="250" />
                </q-field>
                <q-field>
                    <q-select
                            v-model="type"
                            float-label="Typ"
                            :options="selectOptions"
                    />
                </q-field>
                <q-field :count="10">
                    <q-input float-label="Price" v-model="price" max-length="10" />
                </q-field>
                <q-field :count="10">
                    <q-input float-label="Quantity" v-model="number" max-length="10" />
                </q-field>
            </q-card-main>
            <q-card-actions class="q-mt-md">
                <div class="row justify-end full-width docs-btn">
                    <q-btn label="Cancel" flat to="/products/index"/>
                    <q-btn label="Update" color="tertiary" @click="updateProduct"/>
                </div>
            </q-card-actions>
        </q-card>
    </div>
</template>

<style lang="stylus">
    .docs-btn .q-btn {
        padding: 15px 20px;
    }
</style>

<script>
import axios from 'axios'

export default {
  data () {
    return {selectOptions: [
      {
        label: 'CD',
        value: 'CD'
      },
      {
        label: 'DVD',
        value: 'DVD'
      },
      {
        label: 'LP',
        value: 'LP'
      }
    ],
    artistName: '',
    albumName: '',
    type: '',
    price: '',
    select: '',
    number: ''
    }
  },
  methods: {
    updateProduct () {
      console.log(this.$route.params.id)
      axios
        .put(`http://localhost/products/` + this.$route.params.id, this.productData)
        .then(response => {
          this.$q.notify({type: 'positive', timeout: 2000, message: 'Produkt bol upraveny'})
        })
        .catch(error => {
          if (error.response.data.errors) {
            Object.entries(error.response.data.errors).forEach(([key, value]) => {
              this.$q.notify({type: 'negative', timeout: 5000, message: value})
            })
          } else {
            this.$q.notify({type: 'negative', timeout: 2000, message: 'Chyba na strane servera'})
          }
        })
    }
  },
  mounted () {
    console.log(`http://localhost/products/` + this.$route.params.id + '/edit')
    axios
      .get(`http://localhost/products/` + this.$route.params.id + '/edit')
      .then(response => {
        this.artistName = response.data.artist_name
        this.albumName = response.data.album_name
        this.type = response.data.type
        this.price = response.data.price
      })
      .catch(error => {
        this.$q.notify({type: 'negative', timeout: 2000, message: 'Loading product: an error has been occured.'})
        console.log(error)
      })
  },
  computed: {
    productData: function () {
      return { artistName: this.artistName, albumName: this.albumName, type: this.type, price: this.price, number: this.number }
    }
  }
}
</script>
