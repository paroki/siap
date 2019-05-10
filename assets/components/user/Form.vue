<template>
    <b-form @submit.prevent="handleSubmit(item)">
        <div v-for="field in fields">
            <b-form-group
                :label="field.label"
                :label-for="'fr-'+field.name"
            >
                <b-input
                    :id="'fr-'+field.name"
                    type="text"
                    :name="field.name"
                    :value="getItem(item, field.name)"
                    v-model="item[field.name]"
                    :v-if="field.type === 'text'"
                    :required="field.required ? field.required:false"
                    :class="['form-control', isInvalid(field.name) ? 'is-invalid' : '']"
                ></b-input>
                <div
                    v-if="isInvalid(field.name)"
                    class="invalid-feedback">{{ violations[field.name] }}</div>
            </b-form-group>
        </div>
    </b-form>
</template>
<script>
    export default {
        props: {
            fields: {
                type: [Array, Object],
                default: () => []
            },

            handleSubmit: {
                type: Function,
                required: true
            },

            handleUpdateField: {
                type: Function,
                required: true
            },

            values: {
                type: Object,
                required: true
            },

            errors: {
                type: Object,
                default: () => {}
            },

            initialValues: {
                type: Object,
                default: () => {}
            }
        },

        computed: {
            // eslint-disable-next-line
            item () {
                return this.initialValues || this.values
            },

            violations () {
                return this.errors || {}
            }
        },

        methods: {
            isInvalid (key) {
                return Object.keys(this.violations).length > 0 && this.violations[key]
            },
            getItem(item, name){
                const ret = item && item[name];
                return ret;
            }
        }
    }
</script>
