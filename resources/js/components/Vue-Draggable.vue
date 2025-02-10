<template>
  <div class="grid grid-cols-12">
    <!-- @{{list}} -->
    <div class="col-span-6 grid grid-cols-12">
      <div class="col-span-12 p-4">
        <h3>Danh sách</h3>
        <nested-draggable :tasks="list1" />
      </div>
      <rawDisplayer :value="list1" title="List1" />
      <div class="col-span-3">
      </div>
    </div>
    <div class="col-span-6 p-4">
      <h3 class="w-full ">Đã chọn</h3>
      <draggable class="list-group  w-full h-full" :list="list2" :group="{ name: 'g1' }">
        <div class="list-group-item" v-for="(element, index) in list2" :key="element.name">
          {{ element.name }}
        </div>
      </draggable>
    </div>
    <rawDisplayer class="col-3" :value="list2" title="List 1" />
  </div>
</template>

<script>
import draggable from "vuedraggable";
import nestedDraggable from "./nested";
export default {
  name: "nested-example",
  display: "Nested",
  order: 15,
  components: {
    nestedDraggable
  },
  props: {
    list1: {
      required: true,
      type: Array
    },
    list2: {
      required: true,
      type: Array
    }
  },
  data() {
    return {
     
    };
  },
  methods: {
    checkMove() {
      console.log(123);
    }
  }
};
</script>
<style scoped>
.list-group-item {
  position: relative;
  display: block;
  padding: 10px 15px;
  margin-bottom: -1px;
  background-color: #fff;
  /* border: 1px solid #ddd; */
  width: 100%;
  border: 1px solid #bbb;
}
.list-group{
  border: 1px solid #bbb;
}
.list-group-item {
  cursor: move;
}
</style>