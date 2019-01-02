const xraywebscraping = require('./xraywebscraping');
let val=xraywebscraping.xraywebscraping('https://www.buy-online.es/', '#subcategories li', 'img@src', 'h5', 'h5 a@href'); // val is "Hello"

console.log(xraywebscraping);
