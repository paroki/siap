import * as types from "./types";

export default {
    [types.SIAP_LOGIN_RESET](state) {
        Object.assign(state, {
            loggingIn: false,
            loginError: false,
            isLoading: false,
            drawer: null
        });
    },

    [types.SIAP_TOGGLE_LOADING](state) {
        Object.assign(state, { isLoading: !state.isLoading });
    },

    [types.SIAP_LOGIN_START](state) {
        Object.assign(state, { loggingIn: true });
    },

    [types.SIAP_LOGIN_END](state) {
        Object.assign(state, { loggingIn: false });
    },

    [types.SIAP_LOGIN_ERROR](state, loginError) {
        Object.assign(state, { loginError });
    },

    [types.SIAP_SNACKBAR](state, snackbar) {
        Object.assign(state, { snackbar });
    },

    [types.SIAP_TOGGLE_DRAWER](state, drawer) {
        Object.assign(state, { drawer });
    }
};
