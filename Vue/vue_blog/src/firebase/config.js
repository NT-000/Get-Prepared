import { initializeApp } from "firebase/app";
import { getFirestore} from "firebase/firestore";
import {getAuth} from 'firebase/auth'


const firebaseConfig = {
  apiKey: "AIzaSyBpTGVpI04mgG0nBKeqQlPSsKdhXLhZPc8",
  authDomain: "the-blog-firebase.firebaseapp.com",
  projectId: "the-blog-firebase",
  storageBucket: "the-blog-firebase.appspot.com.app",
  messagingSenderId: "391920365697",
  appId: "1:391920365697:web:c3b803f2038f82850a9d80",
  measurementId: "G-Q0S124QMCT"
};

const app = initializeApp(firebaseConfig);

const projectFirestore = getFirestore(app)
const projectAuth = getAuth(app)


export { projectFirestore, projectAuth };
