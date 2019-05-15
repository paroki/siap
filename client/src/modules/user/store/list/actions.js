import ApiService from "@/services/ApiService";

import * as types from "./mutation_types";

const generateParams = payload => {
    if (!payload) return [];
    const sortOrder = payload.descending ? "desc" : "asc";
    const params = [];
    params.push(`page=${payload.page}`);
    if (payload.sortBy) {
        params.push(`order[${payload.sortBy}]=${sortOrder}`);
    }
    return params;
};

export const setPager = ({ commit }, payload) => {
    commit(types.SET_PAGER, payload);
};

const getItems = ({ commit, state }, payload) => {
    payload = state.pager;

    const params = generateParams(payload);
    const url = `/api/user?` + params.join("&");
    commit(types.TOGGLE_LOADING);
    return ApiService.get(url)
        .then(data => {
            commit(types.TOGGLE_LOADING);
            commit(types.SET_ITEMS, data["hydra:member"]);
            commit(types.SET_VIEW, data["hydra:view"]);
            commit(types.SET_TOTAL_ITEMS, data["hydra:totalItems"]);
        })
        .catch(e => {
            commit(types.TOGGLE_LOADING);
            commit(types.SET_ERROR, e.message);
        });
};

export default getItems;
