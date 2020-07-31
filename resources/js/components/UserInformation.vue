<template>
  <v-card 
    class="mx-auto mb-5"
    max-width="500"
  >
    <v-toolbar color="grey" dark dense flat>
      <span class="title font-weight-light">Profile Information</span>
    </v-toolbar>
    <v-form id="form" ref="form" v-model="valid">
      <v-card-text>
        <v-alert :type="errorType" v-if="errorMessage != null">
            {{ errorMessage }}
        </v-alert>
        <v-col cols="12" class="py-0">
          <v-text-field 
            v-model="forms.name" 
            v-validate="'required|max:50'"
            :counter="50" 
            :error-messages="errors.collect('name')"
            data-vv-name="name"
            label="Name" 
            required 
          ></v-text-field>
        </v-col>
        <v-col cols="12" class="py-0">
          <v-text-field 
            v-model="forms.mobile" 
            :counter="11" 
            label="Mobile" 
          ></v-text-field>
        </v-col>
        <v-col cols="12" class="py-0">
          <v-menu
              ref="birthdate"
              v-model="birthdate"
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field
                  v-model="forms.birthdate"
                  v-on="on"
                  hint="YYYY-MM-DD"
                  append-icon="mdi-calendar"
                  label="Birthdate"
                  persistent-hint
              ></v-text-field>
            </template>
            <v-date-picker 
              v-model="forms.birthdate" 
              no-title 
              @input="birthdate = false"
            ></v-date-picker>
          </v-menu>
        </v-col>
        <v-col cols="12" class="py-0">
            <v-autocomplete 
                v-model="forms.gender" 
                :items="gender_data"
                label="Gender" 
            ></v-autocomplete>
        </v-col>
        <v-col cols="12" class="py-0">
          <v-text-field 
            v-model="forms.age" 
            :counter="3" 
            label="Age" 
          ></v-text-field>
        </v-col>
        <v-col cols="12" class="py-0">
          <v-textarea
            v-model="forms.address" 
            :counter="200" 
            label="Address"
            rows="2"
          ></v-textarea>
        </v-col>
      </v-card-text>
      <v-divider></v-divider>
      <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" @click="updateForm()">Update</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
  import { mapGetters } from 'vuex';

  export default {
    props: {
      userInformation: [Object, Array]
    },
    data() {
      return {
        valid: false,
        errorMessage: null,
        errorType: 'error',
        birthdate: false,
        forms: {
          name: null,
          mobile: null,
          gender: null,
          birthdate: null,
          address: null,
          age: null,
        },
        gender_data: ['Male', 'Female', 'Other'],
      }
    },
    watch: {
      userInformation() {
        if( Object.keys(this.userInformation).length != 0) {
          this.forms.name = this.userInformation.name;
          if(this.userInformation.information) {
            this.forms.mobile = this.userInformation.information.mobile;
            this.forms.gender = this.userInformation.information.gender;
            this.forms.birthdate = this.userInformation.information.birthdate;
            this.forms.address = this.userInformation.information.address;
            this.forms.age = this.userInformation.information.age;
          }
        }
      }
    },
    methods: {
      updateForm() {
        this.$validator.validateAll().then((result) => {
          if (result) {
            this.$store.dispatch('UPDATE_PROFILE', this.forms).then(res => {
              this.errorType = 'success';
              this.errorMessage = 'Profile Updated!';
              setTimeout(() => {
                  this.errorMessage = null;
              }, 2500);
            });
          }
        });
      },
    },
  }
</script>