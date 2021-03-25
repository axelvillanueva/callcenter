<template>
  <v-btn
    outlined
    :large="large"
    :block="block"
    :loading="loading"
    @click="$emit('on:click', true)"
    :color="color">
    {{content}}
  </v-btn>
</template>

<script>
export default {
  name: 'mainButton',
  props: {
    content: {required: true},
    block: {type: Boolean},
    loading: {type: Boolean},
    color: {type: String},
    large: {type: Boolean},
  }
}
</script>
