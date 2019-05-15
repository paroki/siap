import * as actions from "./actions";
import * as getters from "./getters";
import mutations from "./mutations";

export default {
    namespaced: true,
    state: {
        error: "",
        paroki: [],
        keuskupan: [],
        loading: false
    },
    actions,
    getters,
    mutations
};
