

<template>
  <form @submit.prevent="passSubmit">
    <label><img src="/email.svg">Email
    </label>
    <input type="email"  required v-model="email">
    <label>
      <img src="/password.svg">Password
    </label>
      <input type="password" required v-model="password">
    <br>
    <h2>Gender</h2>
    <label>Man<img src="/man.svg">
    <input type="radio" value="Man" v-model="gender">
    </label>
    <label>Woman<img src="/woman.svg">
    <input type="radio" value="Female" v-model="gender">
    </label>
    <br>

    <h2 @click="openHobbies">Hobbies <img src="/menu.svg"></h2>
    <div class="hobbies" v-if="isHobbies">
     <label>Soccer<img src="/soccer.svg">
    <input type="checkbox" value="Soccer" v-model="hobbies">
     </label>
      <label>Handball<img src="/handball.svg">
    <input type="checkbox" value="Handball" v-model="hobbies">
      </label>
      <label>Cooking<img src="/cooking.svg">
    <input type="checkbox" value="Cooking" v-model="hobbies">
      </label>
      <label>MMA<img src="/mma.svg">
    <input type="checkbox" value="MMA" v-model="hobbies">
      </label>
      <label>Programming<img src="/programming.svg">
    <input type="checkbox" value="Programming" v-model="hobbies">
      </label>
      <label>Gaming<img src="/esports.svg">
        <input type="checkbox" value="Gaming" v-model="hobbies">
      </label>
    </div>

    <div class="skills">
      <h2 @click="openSkills">Skills<img src="/menu.svg"></h2>
      <div class="selectedSkills" v-if="isSkill" v-for="skill in skills">
        <div><img src="/delete.svg" @click="removeSkill(skill)">{{skill}}</div>
      </div>
      <input type="text" placeholder="ADD YOUR SKILLS..." v-model="tempskill" @keydown="addSkill" >
    </div>

    <div class="occupation">
    <label>Occupation</label>
    <select v-model="selectedOption">
    <option>Cashier</option>
    <option>Student</option>
    <option>Martial Artist</option>
    </select>
    </div>
    <div class="terms">
      <input type="checkbox" value="Yes" v-model="terms" required>
      <label>Accept terms and conditions</label>
    </div>
    <div class="submit"><input type="submit" value="Submit"></div>
    <div class="errorMessage">
      <p>{{errorMessage}}</p>
    </div>
  </form>

  <p>Email: {{ email }}</p>
  <p>Pass: {{ password }}</p>
  <p>Option: {{ selectedOption }}</p>
  <p>Gender: {{ gender }}</p>
  <p>Hobby preferences: {{ hobbies }}</p>
  <p>Terms: {{ terms }}</p>
  <p>Skills: {{ skills }}</p>
  <p>Tempskill: {{ tempskill }}</p>

</template>

<script>
export default {
data(){
  return{
    email: '',
    password: '',
    selectedOption: '',
    gender:'',
    hobbies:[],
    isHobbies: false,
    terms:false,
    isSkill: false,
    tempskill:'',
    skills: [],
    errorMessage: '',
  }
},
  methods:{
  openHobbies(){
    this.isHobbies = !this.isHobbies;
  },
    openSkills(){
    this.isSkill = !this.isSkill;
    },
    addSkill(event){
    console.log("AddSkill", event);
    if(!this.skills.includes(this.tempskill.trim()) && !this.tempskill.startsWith(',') ) {
      if (event.key === ',' || event.key === 'Enter' && this.tempskill.trim() !== '' && this.tempskill !== ',') {
        this.skills.push(this.tempskill.trim());
        this.tempskill = '';
      }
    }
    },
    removeSkill(input){
      this.skills = this.skills.filter(skill => skill !== input);
    },
    passSubmit() {
      if (this.password.length > 5) {
        this.errorMessage = "Form submitted!";
      }
      else{
        this.errorMessage = "Password must be at least 6 characters";
      }
    }
  },
}
</script>

<style scoped>
form {
  max-width: 420px;
  margin: 30px auto;
  background: white;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}
label {
  color: #aaa;
  display: inline-block;
  margin: 10px 10px 10px 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
input, select {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}
input[type="checkbox"] {
  display: inline-block;
  width: 16px;
  margin: 0 10px 0 0;
  position: relative;
  top: 2px;
}
input[type="radio"] {
  height: 20px;
  margin-top: 8px;
  position: relative;
  right: 18px;
  bottom: 5px;
}
label img{
  height: 40px;
  margin-right: 10px;
  vertical-align: middle;
}

.selectedSkills{
  display: inline-block;
  margin: 20px 10px 0 0;
  padding: 6px 12px;
  background: #eee;
  border-radius: 10px;
  font-weight: bold;
  font-size: 12px;
  text-transform: uppercase;
  color: #555;
  cursor: pointer;
}
h2{
  text-transform: uppercase;
}
</style>
