<!-- resources/js/Components/LinkDiv.vue -->
<template>
  <div :class="classes" @click="handleClick">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    className: {
      type: String,
      default: '',
    },
    href: {
      type: String,
      default: '#',
    },
  },
  computed: {
    classes() {
      return [`link-div ${this.className}`];
    },
  },
  methods: {
    handleClick() {
      if (this.href !== '#') {
        window.location.href = this.href;
      }
      this.$emit('click');
    },
  },
};
</script>

<style scoped>
.link-div {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  color: #007bff;
  cursor: pointer;
  text-decoration: underline;
  transition: color 0.3s;
}

.link-div:hover {
  color: #0056b3;
}
</style>

