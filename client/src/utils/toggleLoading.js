import * as siap from "@/modules/main/store/types";

export default function(commit) {
    commit(`siap/${siap.SIAP_TOGGLE_LOADING}`, null, { root: true });
}
