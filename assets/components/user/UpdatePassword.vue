<template>
  <CRow>
    <CCol :xs="12">
      <CCard class="mb-4">
        <CCardHeader>Update Password</CCardHeader>
        <CCardBody>
          <CForm>
            <div class="mb-3">
              <CFormLabel for="oldPassword">Password Lama</CFormLabel>
              <CFormInput id="oldPassword" type="password" v-model="oldPassword">Password Lama</CFormInput>
            </div>
            <div class="mb-3">
              <CFormLabel for="newPassword">Password Baru</CFormLabel>
              <CFormInput id="newPassword" type="password" v-model="newPassword"/>
            </div>
            <div class="mb-3">
              <CFormLabel for="newPasswordConfirm">Masukkan kembali password anda</CFormLabel>
              <CFormInput id="newPasswordConfirm" type="password" v-model="newPasswordConfirm"/>
            </div>
          </CForm>
        </CCardBody>
        <CCardFooter>
          <CButton color="primary" @click="changePassword">Ubah Password</CButton>
        </CCardFooter>
      </CCard>
    </CCol>
  </CRow>
</template>
<script>
import routing from "../../utils/routing";
import user from "../../utils/user";

export default {
  data(){
    return {
      oldPassword: "",
      newPassword: "",
      newPasswordConfirm: ""
    }
  },
  methods: {
    changePassword(){
      const data = {
        oldPassword: this.oldPassword,
        newPassword: this.newPassword
      }
      const url = routing.generate('user_update_password', [], true)
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': 'Bearer '+ user.token
        },
        body: JSON.stringify(data)
      }

      fetch(new URL(url),options)
        .then(response => {
          if(response.ok){

          }
        }).catch( err => {

        })
      console.log('hello world')
    }
  }
}
</script>