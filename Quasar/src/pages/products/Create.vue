<template>
    <div class="q-my-xl">
        <q-card>
            <q-card-title>Create new product</q-card-title>
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
                <q-field>
                    <q-select
                            float-label="Zaner"
                            multiple
                            color="tertiary"
                            v-model="multipleSelect"
                            :options="selectOptionsGenres"
                    />
                </q-field>
                <q-field :count="10">
                    <q-input float-label="Price" v-model="price" max-length="10" />
                </q-field>
                <q-field>
                    <q-input float-label="Quantity" v-model="number" max-length="10" />
                </q-field>
                <q-field>
                    <q-input float-label="year" v-model="year" max-length="10" />
                </q-field>
                <div>
                    <input type="file" accept="image/jpeg" @change=uploadImage ref="fileInput">
                </div>
            </q-card-main>
            <q-card-actions class="q-mt-md">
                <div class="row justify-end full-width docs-btn">
                    <q-btn label="Create" color="tertiary" @click="createProduct"/>
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
// import { required } from 'vuelidate/lib/validators'

export default {
  data () {
    return {
      selectOptions: [
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
      // form: {
      artistName: '',
      albumName: '',
      type: '',
      price: '',
      number: '',
      year: '',
      multipleSelect: [1, 2],
      // },
      select: '',
      image: null,
      fileInput: '',
      selectOptionsGenres: [
        {
          label: 'Rock',
          value: 1
        },
        {
          label: 'Punk',
          value: 2
        },
        {
          label: 'Metal',
          value: 3
        },
        {
          label: 'Pop',
          value: 4
        },
        {
          label: 'Disco',
          value: 5
        }
      ]
    }
  },
  methods: {
    createProduct () {
      // console.log(this.$refs.uploader.files)
      // console.log('data ', this.productData)
      axios
        .post(`http://localhost/products`, this.productData)
        .then(response => {
          // console.log(response)
          this.$q.notify({type: 'positive', timeout: 2000, message: 'The product has been created.'})
          if (response.data.id > 0) {
            this.$router.push({path: '/products/' + response.data.id + '/edit'})
          }
        })
        .catch(error => {
          if (error.response.data.errors) {
            Object.entries(error.response.data.errors).forEach(([key, value]) => {
              this.$q.notify({type: 'negative', timeout: 5000, message: value})
            })
          } else {
            this.$q.notify({type: 'negative', timeout: 2000, message: 'Chyba na strane servera'})
          }

          // console.log('toto je error : ', error.response.data.message)
          // if (error.response.data.message) {
          //   this.$q.notify({type: 'negative', timeout: 2000, message: error.response.data.message})
          // } else {
          //   this.$q.notify({type: 'negative', timeout: 2000, message: 'Chyba na strane servera'})
          // }
          console.log(error)
        })
    },
    uploadImage () {
      this.image = this.$refs.fileInput.files[0]
      var form = new FormData()
      form.append('file', this.image)
      axios
        .post('http://localhost/image/store', form)
        .then(response => {
          this.$q.notify({type: response.data.status, timeout: 2000, message: response.data.msg})
        }).catch(error => {
          if (error.response.data.message) {
            this.$q.notify({type: 'negative', timeout: 2000, message: error.response.data.message})
          } else {
            this.$q.notify({type: 'negative', timeout: 2000, message: 'Chyba na strane servera'})
          }
          console.log(error.response)
        })
    }
  },
  computed: {
    productData: function () {
      if (this.image) {
        return { artistName: this.artistName, albumName: this.albumName, type: this.type, price: this.price, year: this.year, number: this.number, img_link: 'storage/img/' + this.image.name, multipleSelect: this.multipleSelect }
      } else {
        return { artistName: this.artistName, albumName: this.albumName, type: this.type, price: this.price, year: this.year, number: this.number, img_link: 'storage/img/NO-IMAGE.png', multipleSelect: this.multipleSelect }
      }
    }
  }
}
</script>
