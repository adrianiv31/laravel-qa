<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="title">Question Title</label>
            <input type="text" name="title" v-model='title' :class="errorClass('title')">

            <div v-if="errors['title'][0]" class="invalid-feedback">
                <strong>{{ errors['title'][0] }}</strong>
            </div>
        </div>
        <div class="form-group">
            <label for="body">Question Body</label>
            <m-editor :body="body" name="question-body">
                <textarea type="text" name="body" v-model='body' :class="errorClass('body')" rows="10"></textarea>

                <div v-if="errors['body'][0]" class="invalid-feedback">
                    <strong>{{ errors['body'][0] }}</strong>
                </div>
            </m-editor>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-secondary">{{ buttonText }}</button>
        </div>
    </form>
</template>

<script>
    import EventBus from "../event-bus"
    import MEditor from "./MEditor.vue"

    export default {
        props: {
            isEdit: {
                type: Boolean,
                default: false
            }
        },

        components: {MEditor},

        data() {
            return {
                title: '',
                body: '',
                errors: {
                    title: [],
                    body: []
                }
            }
        },

        mounted() {
            EventBus.$on('error', errors => this.errors = errors)

            if (this.isEdit) {
                this.fetchQuestion();
            }
        },

        computed: {
            buttonText() {
                return this.isEdit ? 'Update Question' : 'Ask Question'
            }
        },

        methods: {
            handleSubmit() {
                this.$emit('submitted', {
                    title: this.title,
                    body: this.body
                })
            },

            errorClass(column) {
                return [
                    'form-control',
                    this.errors[column] && this.errors[column][0] ? 'is-invalid' : ''
                ];
            },
            fetchQuestion () {
                axios.get(`/questions/${this.$route.params.id}`)
                    .then(({ data }) => {
                        this.title = data.title
                        this.body = data.body
                    })
                    .catch(error => {
                        console.log(error.response);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
