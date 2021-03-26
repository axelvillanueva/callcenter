<template>
  <v-app class="app-wrapper">
    <v-main class="d-flex align-center">
      <v-container>
        <!-- Login header -->
        <v-row>
          <v-col cols="12" class="text-center">
            <img src="/brand_completed.webp" alt="VIBA" width="80px" />
          </v-col>

          <v-col xl="5" lg="5" class="mx-auto">
            <h1 class="deep-purple--text font-weight-light">Sign In</h1>
          </v-col>
        </v-row>

        <!-- Login form -->
        <v-row>
          <v-col xl="5" lg="5" class="mx-auto">
            <ValidationObserver ref="form">
              <v-form>
                <ValidationProvider rules="required|email" v-slot="{ errors }">
                  <v-text-field
                    autofocus
                    color="deep-purple"
                    label="Email"
                    class="mb-2"
                    :error-messages="errors[0]"
                    v-model="formInputs.email"
                  />
                </ValidationProvider>

                <ValidationProvider rules="required" v-slot="{ errors }">
                  <v-text-field
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

                <template>
                  <Button
                    block
                    large
                    @on:click="useLogin"
                    :loading="isLoading"
                    color="deep-purple"
                    content="Sign in"
                  />
                </template>

                <div class="recovery-link mt-5 text-right">
                  <nuxt-link
                    to="/recovery"
                    class="text-decoration-none deep-purple--text"
                  >
                    ¿Forgot password?
                  </nuxt-link>
                </div>
              </v-form>
            </ValidationObserver>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { reactive, ref, onMounted } from "@nuxtjs/composition-api";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
  components: {
    ValidationObserver,
    ValidationProvider,
  },

  setup() {
    const formInputs = reactive({ email: null, password: null });
    const form = ref(null);
    const showPasswordText = ref(false);
    const isLoading = ref(false);

    /**
     * Login with the collected user data
     * @return redirect to the home page
     */
    const useLogin = async () => {
      const isValid = await form.value.validate();
      if (!isValid) return false;

      try {
        isLoading.value = true;
      } catch (error) {
        console.error(error);
        return (isLoading.value = false);
      }
    };

    return { form, formInputs, useLogin, isLoading, showPasswordText };
  },
};
</script>
