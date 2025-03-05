import {ref} from "vue";
import {projectAuth, projectFirestore} from "@/firebase/config.js";
import { createUserWithEmailAndPassword, updateProfile } from "firebase/auth";
import {setDoc, doc, collection, Timestamp} from "firebase/firestore";

const error = ref('')
const signup = async (email,gender,hobbies, name, occupation,password, skills) => {
error.value = ''
  try{
 const res = await createUserWithEmailAndPassword(projectAuth, email, password)
    if(!res){
      throw new Error('Did not create user with email and password')
    }

    await setDoc(doc(collection(projectFirestore, "users"), res.user.uid), {
      uid: res.user.uid,
      email,
      name,
      gender,
      hobbies,
      occupation,
      skills,
      createdAt: Timestamp.now(),
    });
    error.value = ''
    return res
  }catch(err){
  console.log(err.message)
    error.value = err.message
  }
}

const useSignup = () => {

  return {error, signup}
}

export default useSignup
