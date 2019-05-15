import * as types from "./types";
import fetch from "@/services/ApiService";

export const paroki = ({ commit }, term) => {
    let url = `/api/reference/search/paroki?terms=${term}`;

    commit(types.TOGGLE_LOADING);
    return fetch(url)
        .then(response => response.json())
        .then(data => {
            commit(types.PAROKI, data["hydra:member"]);
            commit(types.TOGGLE_LOADING);
        })
        .catch(() => {
            commit(types.TOGGLE_LOADING);
        });
};
