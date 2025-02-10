<template>
    <draggable class="dragArea" tag="ul" :list="tasks" :group="{ name: 'g1' }">
      <li v-for="el in tasks" :key="el.name">
        <p class="mb-2">{{ el.name }}</p>
        <nested-draggable v-if="el.hasOwnProperty('children')"  :tasks="el.children" />
      </li>
    </draggable>
  </template>
  <script>
  import draggable from "vuedraggable";
  export default {
    props: {
      tasks: {
        required: true,
        type: Array
      }
    },
    components: {
      draggable
    },
    name: "nested-draggable"
  };
  </script>
  <style scoped>
  .dragArea {
    min-height: 50px;
    border: 1px solid #ddd;
  }
  li {
    position: relative;
    display: block;
    padding: 10px 15px;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid #ddd;
    width: 100%;
}
  </style>