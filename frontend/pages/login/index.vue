<template>
  <v-app class="app-wrapper">
    <v-main class="d-flex align-center">
      <v-container>
        <v-row>
          <v-col xl="5" lg="5" class="mx-auto">
            <h1 class="deep-purple--text font-weigth-light">Sign In</h1>
          </v-col>
        </v-row>
        <v-row>
          <v-col xl="5" lg="5" class="mx-auto">
            <ValidationObserver ref="form">
              <v-form>
                <ValidationProvider rules="required|email" v-slot="{ errors }">
                  <v-text-field
                    autofocus
                    outline
                    color="deep-purple"
                    label="Email"
                    class="mb-2"
                    :error-messages="errors[0]"
                    v-model="formInputs.email"
                  />
                </ValidationProvider>
                <ValidationProvider rules="required" v-slot="{ errors }">
                  <v-text-field
                    autofocus
                    outline
                    color="deep-purple"
                    label="Password"
                    class="mb-5"
                    :error-messages="errors[0]"
                    :append-icon="!showPasswordText ? 'mdi-eye' : 'mdi-eye-off'"
                    @click:append="showPasswordText = !showPasswordText"
                    :type="showPasswordText ? 'text' : 'password'"
                    v-model="formInputs.password"
                  />
                </ValidationProvider>
              </v-form>
            </ValidationObserver>
            <template>
              <v-btn
                v-if="!isLoading"
                @click="useLogin"
                large
                block
                color="primary"
                elevation="3"
              >
                Ingresar
              </v-btn>

              <v-btn
                v-else
                block
                large
                color="primary"
                elevation="3"
                loading
              ></v-btn>
            </template>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { ref, reactive, onMounted } from '@nuxtjs/composition-api';
import {ValidationObserver, ValidationProvider} from "vee-validate";

export default {
  components: {
    ValidationObserver,
    ValidationProvider,
  },

  setup() {
    const formInputs = reactive({email: null, password: null});
    const isLoading = ref(false);
    const form = ref(null);
    const showPasswordText = ref(false);
    const useLogin = async () => {
      console.log(formInputs);
      const isValid = await form.value.validate();
      if (!isValid) return false;
      try {
        isLoading.value = true;
      } catch (error) {
        console.log(error);
        return isLoading.value = false;
      }
    };

  return {
    form,
    isLoading,
    showPasswordText,
    useLogin,
    formInputs,
  };
  }
};
</script>

<style>
</style>
