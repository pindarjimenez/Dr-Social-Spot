<template>
    <v-main>
        <v-container class="fill-height" fluid>
            <v-overlay :value="overlay">
                <v-progress-circular indeterminate size="64"></v-progress-circular>
            </v-overlay>
            <v-row align="center" justify="center">
                <v-col cols="12" sm="8" md="4">
                    <v-form id="form" ref="form" v-model="valid">
                        <v-card class="elevation-12">
                            <v-toolbar color="primary" dark flat>
                              <v-toolbar-title>{{ method == 'register' ? 'Register' : 'Login' }} Form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-alert :type="errorType" v-if="errorMessage != null">
                                    {{ errorMessage }}
                                </v-alert>
                                <v-text-field
                                    v-show="method == 'register'"
                                    v-model="forms.name"
                                    v-validate="method == 'register' ? 'required' : ''"
                                    :error-messages="errors.collect('name')"
                                    data-vv-name="name"
                                    label="Name"
                                    prepend-icon="mdi-account-box-outline"
                                    type="text"
                                    autofocus="autofocus" 
                                    placeholder="John Doe"
                                />
                                <p v-if="formErrors['name']" class="red--text ml-8">{{ formErrors['name'][0] }}</p>

                                <v-text-field
                                    v-model="forms.email"
                                    v-validate="'required|email'"
                                    :error-messages="errors.collect('email')"
                                    data-vv-name="email"
                                    label="Email address"
                                    prepend-icon="mdi-account"
                                    type="text"
                                    autofocus="autofocus" 
                                    placeholder="johndoe@gmail.com"
                                />
                                <p v-if="formErrors['email']" class="red--text ml-8">{{ formErrors['email'][0] }}</p>

                                <v-text-field
                                    v-model="forms.password"
                                    v-validate="'required|min:6|max:35'"
                                    :error-messages="errors.collect('password')"
                                    data-vv-name="password"
                                    label="Password"
                                    prepend-icon="mdi-lock"
                                    type="password"
                                    ref="password"
                                    placeholder="********"
                                />
                                <p v-if="formErrors['password']" class="red--text ml-8">{{ formErrors['password'][0] }}</p>

                                <v-text-field
                                    v-show="method == 'register'"
                                    v-model="forms.confirm_password"
                                    v-validate="method == 'register' ? 'required|confirmed:password|min:6|max:35' : ''"
                                    :error-messages="errors.collect('confirm_password')"
                                    data-vv-name="confirm_password"
                                    data-vv-as="confirm password"
                                    label="Confirm password"
                                    prepend-icon="mdi-lock"
                                    type="password"
                                    placeholder="********"
                                />
                                <p v-if="formErrors['confirm_password']" class="red--text ml-8">{{ formErrors['confirm_password'][0] }}</p>
                            </v-card-text>
                            <v-card-actions v-if="method == 'login'">
                                <v-spacer />
                                <v-btn color="success" @click="setMethod('register')">Register</v-btn>
                                <v-btn color="primary" @click="loginForm()">Login</v-btn>
                            </v-card-actions>
                            <v-card-actions v-else>
                                <v-spacer />
                                <v-btn color="error" @click="setMethod('login')">Cancel</v-btn>
                                <v-btn color="success" @click="registrationForm()">Register</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</template>

<script>
export default {
    data() {
        return {
            valid: false,
            overlay: false,
            errorMessage: null,
            errorType: 'error',
            formErrors: [],
            method: 'login',
            forms: {
                name: '',
                email: '',
                password: '',
                confirm_password: '',
            }
        }
    },
    methods: {
        setMethod(value) {
            this.method = value;
            this.formErrors = [];
            this.$validator.reset();
        },
        loginForm() {
            this.formErrors = [];
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.overlay = true;
                    axios.post('/login', this.forms)
                    .then((res) => {
                        if(res.data['error']) {
                            this.overlay = false;
                            this.errorType = 'error';
                            this.errorMessage = 'Invalid email address and password';
                            setTimeout(() => {
                                this.errorMessage = null;
                            }, 2500);
                        } else {
                            this.overlay = false;
                            location.href = '/';
                        }
                    })
                    .catch(error => {
                        let statusCode = error.response.status;
                        if (statusCode == 422) {
                            this.formErrors = error.response.data.errors;
                        }
                        this.overlay = false;
                    });
                }
            });
        },
        registrationForm() {
            this.formErrors = [];
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.overlay = true;
                    axios.post('register', this.forms)
                    .then((res) => {
                        this.overlay = false;
                        this.errorType = 'success';
                        this.errorMessage = 'Registered';
                        setTimeout(() => {
                            this.errorMessage = null;
                        }, 2500);
                            
                        this.setMethod('login');
                    })
                    .catch(error => {
                        let statusCode = error.response.status;
                        if (statusCode == 422) {
                            this.formErrors = error.response.data.errors;
                        }
                        this.overlay = false;
                    });
                }
            });
        },
    },
    mounted() {
        window.addEventListener("keypress", function(e) {
            if(e.keyCode === 13) {
                if(this.method == 'login') {
                    this.loginForm();
                } else {
                    this.registrationForm();
                }
            }
        }.bind(this));
    }
}
</script>
