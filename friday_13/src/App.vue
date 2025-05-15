<script setup>
import { ref } from 'vue';

const startDate = ref(null);
const message = ref('');
const errorMessage = ref('');
const counter = ref(1);
const running = ref(false);
const failCounter = ref(0);
const crashed = ref(false);
const errorQuotes = ref(['Nei og nei, programmet krasjet!', 'Oops, en liten krasj...', 'Noen ganger krasjer ting...', 'Ånei, programmet krasjet visst...']);
const errorQuotes2 = ref(['Her krasjet det visst igjen...', 'Ooopsii, det krasjet!', 'Jaja, sånn skjer...'])
const audio = new Audio('Lobby.wav')
audio.volume = 1.0;
audio.loop = true;
const succeeded = () => {
	if(failCounter.value >= 10){
		return Math.random() < 1
	}
	else{
	return Math.random() < 0.95;
	}
}
const calculate = () => {
	crashed.value = false;
	message.value = ""
	errorMessage.value = ""
	if (running.value || !startDate.value) return;
	audio.play();
	const date = new Date(startDate.value);
	
	let days = 0;
	while (!(date.getDate() === 13 && date.getDay() === 5)) {
		date.setDate(date.getDate() + 1);
		days++;
	}

	const intervalId = setInterval(() => {
		if (succeeded()) {
			counter.value++;
			if (counter.value >= 100) {
				clearInterval(intervalId);
				running.value = false;
				message.value = days === 0 ? `Neste fredag den 13: ${date.toLocaleDateString()} er samme dag som valgt dato.` : `Neste fredag den 13: ${date.toLocaleDateString()} er om ${days} dager.`;
				audio.pause();
			}
		} else {
			clearInterval(intervalId);
			running.value = false;
			counter.value = 0;
			failCounter.value++
			console.log('FailCounter: ', failCounter.value);
			crashed.value = true;
			if(failCounter.value >= 5) {
				errorMessage.value = errorQuotes.value[Math.floor(Math.random() * errorQuotes.value.length)];
			}
			else if( failCounter.value <= 5){
				errorMessage.value = errorQuotes2.value[Math.floor(Math.random() * errorQuotes2.value.length)];
			}
			setTimeout(() => calculate(), 2000);
		}
	}, 100);
	
}


</script>

<template>
	<div class="app" :class="{active: crashed}">
		<div class="container" v-if="!crashed">
		<label>
			<input type="date" v-model="startDate" />
		</label>
		<button @click="calculate(startDate)">Neste fredag den 13</button>
		<div class="progress-container">
		<div class="progress-bar" :style="{width: counter + '%'}" :class="{active: counter < 50}">{{counter}}%</div>
		</div>
		</div>
		
		<p v-if="message"><strong>{{ message }}</strong></p>
		<div class="imgs" v-if="crashed"><img src="/hand_m.png" v-if="failCounter <= 5" class="hl"/><img src="/erlend.png"/><img src="/finger.png" class="hr" v-if="failCounter <= 4"/> <img src="/hl.png" v-if="failCounter >= 10" class="hr"/>
		<p v-if="errorMessage" :class="{active: crashed}"><strong>{{ errorMessage }}</strong></p>
		</div>
	</div>
</template>



<style>
.container{
	display: flex;
	flex-direction: column;
}
.hl{
	transform: rotate(-75deg);
	animation: shake 0.3s;
}
@keyframes shake {
	0% { transform: translate(1px, 1px) rotate(0deg); }
	30% { transform: translate(-6px, -10px) rotate(-1deg); }
	60% { transform: translate(10px, 10px) rotate(1deg); }
	100% { transform: translate(1px, -1px) rotate(0deg); }
}

.hr{
	transform:rotate(75deg);
}
p.active{
	color: red;
	font-size: 1.5em;
	font-weight: bolder;
	font-family: "Comic Sans MS", cursive;
}
p{
	color: black;
	font-size: 1.5em;
	font-weight: bold;
	font-family: "Comic Sans MS", cursive;
}
h1.active, label.active, input.active, button.active {
	background-color:blue;
	color: blue;
}

img{
	height: 200px;
	width: 200px;
	margin: 10px;
}
.imgs img{
	animation: shake 0.8s;
}
@keyframes shake {
	0% { transform: translate(1px, 1px) rotate(0deg); }
	10% { transform: translate(-1px, -2px) rotate(-1deg); }
	20% { transform: translate(-3px, 0px) rotate(1deg); }
	30% { transform: translate(3px, 2px) rotate(0deg); }
	40% { transform: translate(1px, -1px) rotate(1deg); }
	50% { transform: translate(-1px, 2px) rotate(-1deg); }
	60% { transform: translate(-3px, 1px) rotate(0deg); }
	70% { transform: translate(3px, 1px) rotate(-1deg); }
	80% { transform: translate(-1px, -1px) rotate(1deg); }
	90% { transform: translate(1px, 2px) rotate(0deg); }
	100% { transform: translate(1px, -2px) rotate(-1deg); }
}
.app.active{
	color: blue;
	background-color: blue;
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	z-index: 9999;
}
label, button,input{
	padding: 10px;
	font-size: 1.5em;
	border-radius: 10px;
}
.app{
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	display: flex;
	position: fixed;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}

button {
	padding: 0.5em 1em;
	border: none;
	background: gray;
	color: white;
	cursor: pointer;
}

.progress-container {
	width: 100%;
	height: 50px;
	background: #e0e0e0;
	border-radius: 4px;
	overflow: hidden;
	margin: 0.5em 0;
	text-align: center;
}

.progress-bar {
	 height: 100%;
	 background-color: green;
	 transition: width 0.3s ease;
 }
.progress-bar.active {
	height: 100%;
	background-color: red;
	transition: width 0.3s ease;
}
</style>