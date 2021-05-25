import LitMeta from './Meta';
import LitMetaSocial from './MetaSocial';

window.Lit.booting(Vue => {
    Vue.component('lit-meta', LitMeta);
    Vue.component('lit-meta-social', LitMetaSocial);
});
