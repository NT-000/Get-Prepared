import {ref} from "vue";
import {projectAuth, projectFirestore} from "@/firebase/config.js";
import { signInWithEmailAndPassword } from "firebase/auth";

const error = ref(null)

const login = async (email, password) => {
  error.value = '';
  try {
    const res = await signInWithEmailAndPassword(projectAuth, email, password);
    error.value = ''
    return res
  }catch(error) {
    error.value = 'Failed login';
  }

}

const useLogin = () => {
  return {error, login}
}

export default useLogin
