<script>
import PollStore from '../stores/PollStore.js';
import Card from "../shared/Card.svelte";
import Button from "../shared/Button.svelte";

export let poll;
$: totalVotes = poll.votesA + poll.votesB;

$: votesABarWidth = Math.floor((poll.votesA / totalVotes) * 100) || 0;
$: votesBBarWidth = Math.floor((poll.votesB / totalVotes) * 100) || 0;


const handleVote = (option, id) => () => {

    PollStore.update(currentPolls =>  {
        let pollCopy = [...currentPolls]
        let upvotedPoll = pollCopy.find((poll) => poll.id == id)

        option === 'a' ? upvotedPoll.votesA++ : upvotedPoll.votesB++

        return pollCopy;
    })
}
const handleDelete = (id) => {
    PollStore.update(currentPolls =>  {
        return currentPolls.filter(poll => poll.id != id)
    })
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
            <div class="delete">
                <Button type="secondary" on:click={() => handleDelete(poll.id)}>Delete Poll</Button>
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
    color:black;
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
    transition: width 0.5s ease;
    border-radius: 8px;
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
.delete{
    text-align: center;
    margin-top: 40px;
    margin-bottom: 20px;
}
</style>