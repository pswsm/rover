<template>
  <div>
    <h1>{{ message }}</h1>
  </div>
  <a href="/mission-control">Mission control</a>
</template>

<script>
export default {
  props: {
    message: String,
  },
};
</script>

