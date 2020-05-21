var firebaseConfig = {
    apiKey: "AIzaSyDf1Xj2VNZKAsoFJR_9cFWGASQejA-DCjQ",
    authDomain: "chbcoffee-4efec.firebaseapp.com",
    databaseURL: "https://chbcoffee-4efec.firebaseio.com",
    storageBucket: "chbcoffee-4efec.appspot.com"
};
firebase.initializeApp(firebaseConfig);

var database = firebase.database();

function loadChange(node, callback){
    var ref = database.ref(node);
    ref.on('value',function () {
        callback()
    })
}