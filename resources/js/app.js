import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import ChatForm from "./components/ChatForm.vue";
import Test from "./components/Test.vue";
import ChatMessages from "./components/ChatMessages.vue";
import Alpine from 'alpinejs';
import ChatMessagesLs from "./components/ChatMessagesLs.vue";
import ChatFormLs from "./components/ChatFormLs.vue";

const app = createApp({});
app.component('example-component', ExampleComponent);
app.component('test', Test);
app.component('chat-form', ChatForm);
app.component('chat-form-ls', ChatFormLs);
app.component('chat-message', ChatMessages);
app.component('chat-message-ls', ChatMessagesLs);

app.mount('#app');


window.Alpine = Alpine;

Alpine.start();


