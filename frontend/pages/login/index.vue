<template>
  <v-app class="app-wrapper">
    <v-main class="d-flex align-center">
      <v-container>
        <v-row>
          <v-col xl="5" lg="5" class="mx-auto">
            <h1>
              Inicia sesión
            </h1>
            <p>
              Ingresa tus credenciales a continuación
            </p>
          </v-col>
        </v-row>
        <v-row>
          <v-col xl="5" lg="5" class="mx-auto">
            <v-text-field
              autofocus outline
              label="Correo Electronico"
              v-model="form.email"
            />
            <v-text-field
              outline
              label="Contraseña"
              v-model="form.password"
            />

            <template>
              <v-btn
              v-if="!isLoading"
              @click="onSubmit"
              large block
              color="primary"
              elevation="3">
                Ingresar
              </v-btn>

              <v-btn v-else block large color="primary" elevation="3" loading></v-btn>
            </template>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import {ref, reactive} from '@nuxtjs/composition-api';

export default {
  setup() {
    const form = reactive({email: null, password: null});
    const isLoading = ref(false);
    const onSubmit = () => {console.log(form)
     isLoading.value = !isLoading.value;
    };

  return {
    form,
    isLoading,
    onSubmit
  };
  }
};
</script>

<style>
</style>
