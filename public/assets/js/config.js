// Domain
const domain = "http://localhost:5000/chats";

// MySQL API
const apis = '/chats';

// set image directori
const imageDir = 'uploads/images';

// Replace with: your firebase account
const config = {
    apiKey: "AIzaSyDfKpgAUCOja3z-tc0yHOqzOCEGo0seJAQ",
    databaseURL: "https://chatws-40480.firebaseio.com"
};
firebase.initializeApp(config);

// create firebase child
const dbRef = firebase.database().ref();

const messageRef = dbRef.child('message');
const userRef = dbRef.child('user');
