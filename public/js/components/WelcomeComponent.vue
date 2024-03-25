<template>
  <form @submit.prevent="submit">
    <div>
      <label>first name</label>
      <input v-model.trim="firstName" />
    </div>
    <div>
      <label>last name</label>
      <input v-model.trim="lastName" />
    </div>
    <button type="submit">submit</button>
  </form>
  {{ message }}
</template><script>
export default {
  name: "App",
  data() {
    return {
      firstName: "",
      lastName: "",
      message: "",
    };
  },
  computed: {
    formValid() {
      const { firstName, lastName } = this;
      return firstName.length > 0 && lastName.length > 0;
    },
  },
  methods: {
    submit() {
      if (!this.formValid) {
        return;
      }
      const { firstName, lastName } = this;
      this.message = `hello, ${firstName} ${lastName}`;
    },
  },
};
</script>