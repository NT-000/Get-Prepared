import {ref} from "vue";
import {projectAuth, projectFirestore} from "@/firebase/config.js";
import { signOut } from "firebase/auth";

const error = ref(null)

const logout = async () => {
  error.value = '';
try{
await signOut(projectAuth);
}
catch(err){
  error.value = 'Failed logout';
  console.log('logout err:',err.message);
}
}

const useLogout = () => {
  return {logout,error}
}

export default useLogout;
