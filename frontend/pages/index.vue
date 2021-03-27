<template>
  <h1>Home page</h1>
</template>

<script>
export default {
  layout: 'client',

  mounted() {
    this.$router.push('/administrators');
  }
}
</script>
