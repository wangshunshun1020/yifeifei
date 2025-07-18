import {Base} from '../utils/base.js';
var app = getApp();
class Cars extends Base{
    constructor(){
        super();
    }

    getPubInit(callback,params){
        var that=this;
        var param={
            url: 'v1.Cars/getPubInit',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }


    mySavecar(callback,params){
        var that=this;
        var param={
            url: 'v1.Cars/mySavecar',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }


   


    Savecars(callback,params){
        var that=this;
        var param={
            url: 'v1.Cars/saveCars',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    saveGuest(callback,params){
        var that=this;
        var param={
            url: 'v1.Guest/saveGuest',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    carSave(callback,params){
        var that=this;
        var param={
            url: 'v1.Cars/carSave',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    myPubcars(callback,params){
        var that=this;
        var param={
            url: 'v1.Cars/myPubcars',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }


    Updatecars(callback,params){
        var that=this;
        var param={
            url: 'v1.Cars/updateCars',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    

    Updatejob(callback,params){
        var that=this;
        var param={
            url: 'updatejob',
            type:'post',
            data:params,
            sCallback:function(data){
                data=data;
                callback && callback(data);
            }
        };
        this.request(param);
    }

    getCarsDetail(callback,params){
      var that=this;
      var param={
          url: 'v1.Cars/getCarsDetail',
          type:'post',
          data:params,
          sCallback:function(data){
              data=data;
              callback && callback(data);
          }
      };
      this.request(param);
   }


   getCarsList(callback,params){
    var that=this;
    var param={
        url: 'getcarslist',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }

 getSearchCarsList(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/getSearchCarsList',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }


 getShopCenterCarsList(callback,params){
    var that=this;
    var param={
        url: 'getShopCenterCarsList',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }

 getUserCenterCarsList(callback,params){
    var that=this;
    var param={
        url: 'getShopCenterCarsList',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }


 getXypub(callback,params){
    var that=this;
    var param={
        url: 'getXypub',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }


 delCars(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/delCars',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }

 downCars(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/downCars',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }

 upCars(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/upCars',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }


 getCarsListIndex(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/getcarslistindex',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }

 getCarsListCount(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/getcarslistcount',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }


 getCarsSearchList(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/getCarsSearchList',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }


 getSelectCars(callback,params){
    var that=this;
    var param={
        url: 'v1.Cars/getSelectCars',
        type:'post',
        data:params,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.request(param);
 }



 
 uploadimg(callback,params){
    var that=this;
    console.log(app.globalData.config);
    var param={
        //url: 'v1.Cars/uploadImg',
        url: '',
        data:params,
        storage:app.globalData.config.storage,
        aliosstoken:app.globalData.config.multipart.aliosstoken,
        sCallback:function(data){
            data=data;
            callback && callback(data);
        }
    };
    this.requestuploadimg(param);
 }





};

export {Cars};