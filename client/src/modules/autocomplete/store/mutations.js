import * as types from "./types";

export default {
    [types.RESET](state) {
        Object.assign(state, {
            paroki: [],
            keuskupan: [],
            error: "",
            loading: false
        });
    },

    [types.PAROKI](state, paroki) {
        Object.assign(state, { paroki });
    },

    [types.KEUSKUPAN](state, keuskupan) {
        Object.assign(state, { keuskupan });
    },

    [types.ERROR](state, error) {
        Object.assign(state, { error });
    },

    [types.TOGGLE_LOADING](state) {
        Object.assign(state, { loading: !state.loading });
    }
};
