import * as actions from "./actions";
import * as getters from "./getters";
import mutations from "./mutations";

export default {
    namespaced: true,
    state: {
        error: "",
        isLoading: false,
        items: [],
        view: [],
        totalItems: 0,
        pager: {
            descending: true,
            page: 1,
            rowsPerPage: 5,
            sortBy: null,
            rowsPerPageItems: [5]
        }
    },
    actions,
    getters,
    mutations
};
