
import {Base} from '../utils/base.js';

class Agent extends Base{
    constructor(){
        super();
    }

    agentInit(callback,params){
        var that=this;
        var param={
            url: 'v1.Agent/agentInit',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    Checkagent(callback,params){
      var that=this;
      var param={
          url: 'v1.Agent/checkAgent',
          type:'post',
          data:params,
          sCallback:function(data){
              data=data;
              callback && callback(data);
          }
      };
      this.request(param);
  }

  Agentfxrecord(callback,params){
    var that=this;
    var param={
        url: 'v1.Agent/agentFxrecord',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
}


Getfxrecord(callback,params){
    var that=this;
    var param={
        url: 'v1.Agent/Getfxrecord',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
}



    Saveagent(callback,params){
      var that=this;
      var param={
          url: 'v1.Agent/saveAgent',
          type:'post',
          data:params,
          sCallback:function(data){
              data=data;
              callback && callback(data);
          }
      };
      this.request(param);
  }


  



};

export {Agent};