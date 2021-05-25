<template>
    <lit-col :width="field.width">
        <div class="d-flex justify-content-between">
            <label
                class="mb-2 lit-form-item-title d-flex justify-content-between"
            >
                <span v-html="field.title" />
            </label>
            <a
                v-if="!showEdit && !busy"
                v-html="field.edit_text"
                href="#"
                @click.prevent="showEdit = !showEdit"
            />
        </div>

        <template v-if="!busy">
            <div class="lit-meta-preview mb-3">
                <div class="lit-google-title">{{ meta.title }}</div>
                <div class="lit-google-url">
                    {{ location.origin }}
                    <span style="color: #006621"
                        >›
                        <template v-if="field.route">
                            {{
                                _format(
                                    _.nth(field.route.split('/'), -2),
                                    model
                                )
                            }}
                            ›
                            <span
                                v-html="
                                    encodeURI(
                                        _format(
                                            _.last(field.route.split('/')),
                                            model
                                        )
                                    )
                                "
                            />
                        </template>
                        <template v-else>
                            ...
                        </template>
                    </span>
                </div>

                <div class="lit-google-description">
                    <span>{{ description }}</span>
                </div>
            </div>

            <div v-if="showEdit" class="row">
                <lit-field
                    v-for="(field, index) in field.form.fields"
                    :key="index"
                    :field="field"
                    :model-id="model.id"
                    :model="meta"
                    v-on="$listeners"
                />

                <lit-field
                    v-if="field.slug_field"
                    ref="slugField"
                    :field="field.slug_field"
                    :model="model"
                    @changed="slugChanged"
                    v-on="$listeners"
                />

                <lit-col v-if="slugHasChanged" class="mb-3">
                    <b-form-checkbox
                        id="create-slug-forwarding"
                        v-model="shouldCreateForwarding"
                        name="create-slug-forwarding"
                    >
                        <span v-html="field.create_forwarding_text" />
                        <span class="badge badge-light">{{
                            originalSlug
                        }}</span>
                        -> <span class="badge badge-light">{{ newSlug }}</span>
                    </b-form-checkbox>
                </lit-col>
            </div>
        </template>
        <template v-else>
            <div class="d-flex justify-content-around">
                <lit-spinner />
            </div>
        </template>
    </lit-col>
</template>

<script>
export default {
    name: 'LitMeta',
    props: ['model', 'field'],
    computed: {
        slugHasChanged() {
            return this.originalSlug != this.newSlug;
        },
        location() {
            return window.location;
        },
        description() {
            let description = this.meta.description;

            if (!description) {
                return;
            }

            let split = description.match(/.{1,320}/g);

            description = split[0];

            if (split.length > 1) {
                description += '…';
            }

            return description;
        },
    },
    beforeMount() {
        this.loadMeta();
        Lit.bus.$on('save', this.createForwarding);
        Lit.bus.$on('saveCanceled', () => {
            this.originalSlug = null;
            this.newSlug = null;
        });
    },
    data() {
        return {
            showEdit: false,
            busy: false,
            meta: {},
            originalSlug: null,
            newSlug: null,
            shouldCreateForwarding: true,
        };
    },
    methods: {
        async createForwarding() {
            if (!this.slugHasChanged || !this.shouldCreateForwarding) {
                return;
            }

            let response = await this.sendCreateForwarding();

            if (!response) {
                return;
            }

            this.originalSlug = null;
            this.newSlug = null;
        },
        async sendCreateForwarding() {
            try {
                return await axios.post(
                    `${this.field.route_prefix}/meta/forward`,
                    {
                        field_id: this.field.id,
                        payload: { to: this.newSlug },
                    }
                );
            } catch (e) {
                console.log(e);
            }
        },
        slugChanged(newSlug) {
            this.originalSlug = this.$refs.slugField.original;
            this.newSlug = newSlug;
        },
        async loadMeta() {
            this.busy = true;
            let response = await this.sendLoadMeta();

            if (!response) {
                return (this.busy = false);
            }

            this.meta = this.crud(response.data);

            this.busy = false;
        },
        async sendLoadMeta() {
            try {
                return await axios.post(
                    `${this.field.route_prefix}/meta/load`,
                    {
                        field_id: this.field.id,
                    }
                );
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>

<style>
.lit-meta-preview {
    max-width: 600px;
}

.lit-google-title {
    color: #1a0dab;
    font-family: arial, sans-serif;
    font-size: 20px;
    font-weight: 400;
    height: auto;
    padding-top: 4px;
    font-size: 20px;
    line-height: 1.3;
    display: inline-block;
    line-height: 1.3;
    margin-bottom: 3px;
}

.lit-google-url {
    color: #006621;
    display: block;
    font-family: arial, sans-serif;
    font-style: normal;
    font-weight: normal;
    height: auto;
    line-height: 1.3;
}

.lit-google-description {
    position: relative;
    color: #545454;
    max-width: 48em;
    min-height: 50px;
    line-height: 1.58;
}
.lit-google-description span {
    line-height: 1.58;
    color: #222;
    font-family: arial, sans-serif;
    font-size: 14px;
}

/* .lit-google-description::after {
    position: absolute;
    display: block;
    content: '';
    bottom: 2px;
    right: 0;
    width: 200px;
    height: 20px;
    background-color: rgba(255, 50, 50, 0.5);
} */
</style>
