import {ref} from 'vue'
import {projectFirestore} from "@/firebase/config.js";
import {addDoc, collection} from "firebase/firestore";

const useCollection = (collectionName) => {
  const error = ref(null)

  const addDocument = async (doc) => {
    error.value = '';
    try{
      const colRef = collection(projectFirestore, collectionName);
    await addDoc(colRef, doc)
    }catch(err){
      err.value = 'error, could not add doc'
    }
  }
  return {addDocument, error}
}

export default useCollection
