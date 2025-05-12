<script>

import Card from "../shared/Card.svelte";
import {createEventDispatcher} from "svelte";

const dispatch = createEventDispatcher();
export let poll;
$: totalVotes = poll.votesA + poll.votesB;

$: votesABarWidth = Math.floor((poll.votesA / totalVotes) * 100);
$: votesBBarWidth = Math.floor((poll.votesB / totalVotes) * 100);

const handleVote = (option, id) => () => {
    dispatch('vote', {option, id});
}

</script>

<main>
    <Card>
        <div class="poll">
            <h3>{poll.question}</h3>
            <p>Total votes: {totalVotes}</p>
            <div class="answer" on:click={handleVote('a', poll.id)}>
                <div class="percent percent-a" style="width: {votesABarWidth}%"></div>
                <span>{poll.answer_a} </span>
            </div>
            <div class="answer" on:click={handleVote('b', poll.id)}>
                <div class="percent percent-b" style="width: {votesBBarWidth}%"></div>
                <span>{poll.answer_b}</span>
            </div>
        </div>
    </Card>
</main>

<style>
h3{
    margin: 0 auto;
    color: #555;
}
p{
    margin-top:6px;
    font-size: 14px;
    color: #aaa;
}
.answer{
    background: #fafafa;
    cursor: pointer;
    margin: 10px auto;
    position: relative;
}
.answer:hover{
    opacity: 0.8;
}
span{
    display: inline-block;
    padding: 10px 20px;
}

.percent{
    height: 100%;
    position: absolute;
    box-sizing: border-box;
}
.percent-a{
border-left: 4px solid red;
left: 0;
    background: rgba(217, 27, 66, 0.2);
}
.percent-b{
    border-left: 4px solid green;
    left: 0;
    background: rgba(69, 217, 196, 0.2);
}
</style>