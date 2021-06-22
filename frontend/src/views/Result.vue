<template>
  <div class="container">
    <Card
      v-if="isAdd"
      title="Return Back"
      icon="fas fa-long-arrow-alt-left"
      @click="toggleAdd"
    />
    <Card
      v-else
      title="Add Appoientment"
      icon="fas fa-plus"
      @click="toggleAdd"
    />


    <form class="check" v-if="isAdd" @submit="fetching">
      <div class="input">
        <label for="date">Date :</label>
        <input
          type="date"
          @change="check"
          name="date"
          id="date"
          v-model="date"
        />
        <!-- <input type="hidden" name="clientRef" id="clientRef" v-bind:value="clientRef" /> -->
      </div>
      <div class="slots">
        <div class="input">
          <label class="slot" for="slot1"
            >08:00 <br />
            10:00</label
          >
          <input
            
            type="radio"
            name="slot"
            value="slot1"
            
            v-model="slot"
          />
        </div>
        <div class="input">
          <label class="slot" for="slot2"
            >10:00 <br />
            12:00</label
          >
          <input
            
            
            type="radio"
            name="slot"
            value="slot2"
            v-model="slot"
          />
        </div>
        <div class="input">
          <label class="slot" for="slot3"
            >02:00 <br />
            04:00</label
          >
          <input
            
            
            type="radio"
            name="slot"
            value="slot3"
            v-model="slot"
          />
        </div>
        <div class="input">
          <label class="slot" for="slot4"
            >04:00 <br />
            06:00</label
          >
          <input
            
            
            type="radio"
            name="slot"
            value="slot4"
            v-model="slot"
          />
        </div>
      </div>

      <Button color="primary" text="Reserve" />
    </form>

    <!-- edit form  -->

    <form class="check" v-if="isEdit" @submit="fetching">
      <div class="input">
        <label for="date">Date :</label>
        <input
          type="date"
          @change="check"
          name="date"
          id="date"
          v-model="date"
        />
        <!-- <input type="hidden" name="clientRef" id="clientRef" v-bind:value="clientRef" /> -->
      </div>
      <div class="slots">
        <div class="input">
          <label class="slot" for="slot1"
            >08:00 <br />
            10:00</label
          >
          <input
            
            type="radio"
            name="slot"
            value="slot1"
            
            v-model="slot"
          />
        </div>
        <div class="input">
          <label class="slot" for="slot2"
            >10:00 <br />
            12:00</label
          >
          <input
            
            
            type="radio"
            name="slot"
            value="slot2"
            v-model="slot"
          />
        </div>
        <div class="input">
          <label class="slot" for="slot3"
            >02:00 <br />
            04:00</label
          >
          <input
            
            
            type="radio"
            name="slot"
            value="slot3"
            v-model="slot"
          />
        </div>
        <div class="input">
          <label class="slot" for="slot4"
            >04:00 <br />
            06:00</label
          >
          <input
            
            
            type="radio"
            name="slot"
            value="slot4"
            v-model="slot"
          />
        </div>
      </div>

      <Button color="primary" text="Reserve" />
    </form>
    <table v-if="!isAdd">
      <tr>
        <th>id</th>
        <th>Date</th>
        <th>Time</th>
        <th></th>
      </tr>
      <tr v-for="reservation in reservations" :key="reservation.id">
        <td>{{ reservation.id }}</td>
        <td>{{ reservation.date }}</td>
        <td>
          <span v-if="reservation.slot == 'slot1'">08:00 - 10:00</span>
          <span v-if="reservation.slot == 'slot2'">10:00 - 12:00</span>
          <span v-if="reservation.slot == 'slot3'">02:00 - 04:00</span>
          <span v-if="reservation.slot == 'slot4'">04:00 - 06:00</span>
        </td>
        <td>
          <i class="fas fa-pen"></i
          ><i @click="deleteData(reservation.id)" class="fas fa-trash"></i>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>

import Card from "../components/card.vue";
import Button from "../components/button.vue";

export default {
  components: {
    Card,
    Button,
  },

  data() {
    return {
      reservations: [],
      reservedSlots: [],
      isAdd: false,
      date: "",
      slot: "",
      clientRef: localStorage.getItem("userkey"),
    };
  },
  methods: {
    toggleAdd: function () {
      this.isAdd = !this.isAdd;
    },

    // Posting to Database

    async fetching(e) {
      e.preventDefault();
      const resp = await fetch(
        "http://localhost/vueapp/AppointementController/add",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify({
            date: this.date,
            slot: this.slot,
            clientRef: this.clientRef,
          }),
        }
      );
      const key = await resp.json();
      localStorage.setItem("key", key);
      // console.log(key);
      this.getData().then((data) => {
        this.reservations = data;
      });
      this.isAdd = false;
    },

    // Get Reserved Slots by Date

    async checkAvailability() {
      const response = await fetch(
        `http://localhost/vueapp/AppointementController/check/${this.date}`
      );
      const data = await response.json();

      return data;
    },

    check: function () {
      this.checkAvailability().then((data) => {
        this.reservedSlots = data;

        let inputs = document.getElementsByName("slot");
        //     this.reservedSlots.forEach(element => {
        //       console.log(element.slot)
        //     });
        inputs.forEach((e)=>{
          e.disabled = false;
        })
        for (let i = 0; i < this.reservedSlots.length; i++) {
          const element = this.reservedSlots[i];
 
          for (let j = 0; j < inputs.length; j++) {
            const input = inputs[j];
            
            if (element.slot == input.value) {
              // this.disabled = true;
              input.disabled = true;
            }

            
          }

          // console.log(inputs[i].value)
          // console.log(element.slot)
          // if (inputs[i].value === element.slot) {
          //   console.log("ok");
          // } else {
          //   console.log('not ok')
          // }
        }
      });
    },

    // Get Appoientments by Client Refrence

    async getData() {
      const response = await fetch(
        `http://localhost/vueapp/AppointementController/getApnt/${this.clientRef}`
      );
      const data = await response.json();

      return data;
    },

    // Delete Appoientment by Appoientment ID

    async deleteData(id) {
      console.log(id);
      const resp = await fetch(
        `http://localhost/vueapp/AppointementController/delete/${id}`,
        {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
        }
      );

      this.getData().then((data) => {
        this.reservations = data;
      });
    },
  },

  // Assign result to Variable after page mounting

  mounted() {
    this.getData().then((data) => {
      this.reservations = data;
    });
  },
};
</script>

<style scoped>
.checked {
  background: #000;
}
.container {
  flex-direction: column;
}

.slots {
  display: flex;
}
table {
  width: 70%;
  border-radius: 5px;
  border: 1px solid #d5d5d5;
  padding: 20px;
}

.slot {
  box-shadow: 0 5px 10px #0000001c;
  width: 100px;
  height: 100px;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 15px;
}
input[type="radio"] {
  /* display: none; */
}
.card {
  flex-direction: row;
  gap: 10px;
  height: 150px;
  cursor: pointer;
}
button {
  width: auto;
}
</style>