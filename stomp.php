<?php
require_once 'vendors/Predis/Autoloader.php';
Predis\Autoloader::register();

class Unfollow extends Predis\Command\ScriptedCommand {

    public function getKeysCount() {
        return -1;
    }

    public function getScript() {
        return <<<LUA
    local categories = cjson.decode(ARGV[1])
    local data = redis.call('zrange',KEYS[1],0,-1)
    local obj
    local val
    local found
    for k,v in pairs(data) do
        found = 0
        obj = cjson.decode(v)
        if obj.type == "topic.create" then
            for _,category in pairs(categories) do
                for i,name in  ipairs(obj.categories) do
                    if name == category then
                        found = 1
                    end
                end
                if found==1 then break end
            end
            if found==0 then
                for i,name in  ipairs(obj.categories) do
                    if name == KEYS[2] then
                        redis.call('zrem',KEYS[1],v)
                        val = v
                    end
                end
            end
        end
        
    end
    return val
LUA;
    }

}

$redis = new Predis\Client('tcp://qaalo.com:6379');
$redis->getProfile()->defineCommand('unfollow', 'Unfollow');
var_dump( $redis->unfollow('user:2:timeline','Bilgisayar','["Teknolojil"]'));

?>
