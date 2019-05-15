import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

import siap from "./modules/main/store";
import user from "./modules/user/store";
import autocomplete from "./modules/autocomplete/store";

export default new Vuex.Store({
    modules: {
        siap,
        user,
        autocomplete
    }
});
