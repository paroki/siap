import SubmissionError from "../../../../utils/SubmissionError";
import ApiService from "@/services/ApiService";
import * as types from "./mutation_types";
import toggleLoading from "../../../../utils/toggleLoading";

export const reset = ({ commit }) => {
    commit(types.RESET);
};

export const retrieve = ({ commit }, id) => {
    toggleLoading(commit);

    return ApiService.get(`/api/user/${id}`)
        .then(data => {
            toggleLoading(commit);
            commit(types.SET_RETRIEVED, data);
        })
        .catch(e => {
            toggleLoading(commit);
            commit(types.SET_ERROR, e.message);
        });
};

export const update = ({ commit, state }, payload) => {
    if (!payload) {
        payload = state.retrieved;
    }
    commit(types.SET_ERROR, "");
    commit(types.TOGGLE_LOADING);
    return ApiService.put(state.retrieved["@id"], payload)
        .then(data => {
            commit(types.TOGGLE_LOADING);
            commit(types.SET_UPDATED, data);
        })
        .catch(e => {
            commit(types.TOGGLE_LOADING);

            if (e instanceof SubmissionError) {
                commit(types.SET_VIOLATIONS, e.errors);
                // eslint-disable-next-line
                commit(types.SET_ERROR, e.errors._error);
            } else {
                commit(commit(types.SET_ERROR, e));
            }
        });
};

export const updateRetrieved = ({ commit }, updated) => {
    commit(types.UPDATE_RETRIEVED, updated);
};
