<template>
    <div id="app">
        <treeselect v-model="value" :multiple="multiple" :options="options" placeholder="Chọn dữ liệu"
            :disabled="disabled" :normalizer="normalizer" />
    </div>
</template>

<script>
// import the component
import Treeselect from "@riophae/vue-treeselect";
// import the styles
import "@riophae/vue-treeselect/dist/vue-treeselect.css";

export default {
    // register the component
    components: {
        Treeselect
    },
    props: {
        options: {
            type: Array,
            default: "None",
        },
        value: {
            type: String,
            default: null,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        // changeselect: {
        //     type: String,
        //     default: 'changeselect',
        // },
        disabled: {
            default: 'false',
        }
    },
    data() {
        return {
            // define the default value
            // value: null,
            // define options
            normalizer(node) {
                return {
                    id: node.id,
                    label: node.name,
                    children: node.children,
                }
            },
        };
    },
    watch: {
        value() {
            this.$emit(changeselect, this.value)
        }
    },
};
</script>
