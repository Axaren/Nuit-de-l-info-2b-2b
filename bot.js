var Discord = require('discord.io');
var logger = require('winston');
var auth = require('./auth.json');
// Configure logger settings
logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, {
    colorize: true,
    timestamp: true
});
logger.level = 'debug';

// Initialize Discord Bot
var bot = new Discord.Client({
   token: auth.token,
   autorun: true
});
bot.on('ready', function (evt) {
    logger.info('Connected');
    logger.info('Logged in as: ');
    logger.info(bot.username + ' - (' + bot.id + ')');

    bot.setPresence({
        idle_since: null,
        game: {
            name: '!help'
        }
    });
});
bot.on('message', function (user, userID, channelID, message, evt) {
    var serverID = bot.channels[channelID].guild_id;
    var serverName = bot.servers[serverID].name;
    var channelName = bot.channels[channelID].name;
    // Our bot needs to know if it will execute a command
    // It will listen for messages that will start with `!`
    if (message.substring(0, 1) === '!') {
    logger.info(user + ' on ' + serverName + ': ' + channelName + ' posted ' + message);
    var args = message.substring(1).split(' ');
    var cmd = args[0];

    args = args.splice(1);
    switch (cmd) {

        case 'author':
            var author = 'Axeran#9861';
            bot.sendMessage({
                to: channelID,
                message: 'Woof <@' + userID + '> , BuddyBot was written by **' + author + '** for *Hewpie Sub Discord*. \n You can find the source code here: https://github.com/Axaren/BuddyBot'
            });
            break;

        case 'invite':
            bot.sendMessage({
                to: channelID,
                message: 'Woof **' + user + '**! \n To invite me on your server click this link: \n https://discordapp.com/oauth2/authorize?client_id=375414998916399104&scope=bot'
            });
            break;

        case 'hello':
            bot.sendMessage({
                to: channelID,
                message: 'hi <@' + userID + '> !'
            });
            break;

        case 'rules':
            bot.sendMessage({
                to: channelID,
                message: 'KEEP HEWPIE HAPPY'
            });
            break;

        case 'bark':
            var reciever = args[0];
            bot.sendMessage({
                to: channelID,
                message: '<@' + userID + '> barked at ' + reciever
            });
            break;
    }
}
});