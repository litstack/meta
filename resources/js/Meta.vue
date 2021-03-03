<template>
    <lit-col :width="12" class="pt-4">
        <label class="mb-2 lit-form-item-title d-flex justify-content-between">
            <span>Preview</span>
        </label>
        <div class="lit-meta-preview">
            <div class="lit-google-url">
                {{ location.host }}
                <span style="color: #5f6368;">› ...</span>
            </div>
            <div class="lit-google-title">{{ model.title }}</div>
            <div class="lit-google-description">
                <span>{{ model.description }}</span>
            </div>
        </div>
    </lit-col>
</template>

<script>
export default {
    name: 'LitMeta',
    props: {
        model: {
            required: true,
            type: Object,
        },
    },
    computed: {
        location() {
            return window.location;
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
.lit-google-title:hover {
    text-decoration: underline;
}

.lit-google-url {
    color: #202124;
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

.lit-google-description::after {
    position: absolute;
    display: block;
    content: '';
    bottom: 2px;
    right: 0;
    width: 200px;
    height: 20px;
    background-color: rgba(255, 50, 50, 0.5);
}
</style>
