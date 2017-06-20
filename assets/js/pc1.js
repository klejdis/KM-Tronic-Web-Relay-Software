(function(){

     /**
     *  1. GLOBAL DATA THAT WILL COME FROM SETTINGS
     */
	  var minPrice = 2.5 ; //150 lek 1 or
	  var twormcontoller = 150;
	  var thrermcontoller = 200;
	  var fourrmcontoller = 250;



	  /**
	  * 2. INSTANSIATE THE TIMER
	  */

	  var pc1;
	  instantiateTimer();



	  /**
	  * RECOVER
	  */

	  if (  localStorage.getItem("pc1") != undefined ) {

	  	var litem = JSON.parse( localStorage.getItem("pc1") );


	  	if (litem.openType == 'meLimit') {

	  		setStartTime();

	  		setEndTime(litem.remainingMinutes);

	  		startTimer(pc1 , true , litem.remainingMinutes);

	  		setTotaliNeLek( minutes_to_lek( litem.remainingMinutes , litem.leva )  ); 

	  		bindSecondsUpdatedEventHandler(pc1 , litem.leva  , true);

	  		turnOnPc(1);

	  	}else if(litem.openType == 'paLimit') {

	  		setStartTime();

	  		startTimer(pc1 , false , litem.minutesPassed);

	  		setTotaliNeLek( minutes_to_lek( litem.remainingMinutes , litem.leva )  );

	  		bindSecondsUpdatedEventHandler(pc1 , litem.leva , false );

	  		turnOnPc(1);

	  	}



	  };





	  /**
	  * OPEN BUTTON ON CLICK EVENT HANDER
	  */
	  $('#pc1Open').on('click' , function(e){
	     e.preventDefault();

	     /**
	     * 3. VALIDATE THE FORM
	     */
	     validateForm();

	  });




	  /**
	  * CLOSE BUTTON  ON CLICK EVENT HANDER
	  */
	  $('#pc1stop').on('click' , function(e){
	     e.preventDefault();

	     var litem = JSON.parse( localStorage.getItem("pc1") );

	     if (litem.openType == 'meLimit') {

				pc1.stop();	
				clearStartTime();
				clearEndTime();
				clearTime();
				clearTotaliNeLek();
				localStorage.removeItem("pc1");
				turnOffPc(1);

	     }else if(litem.openType == 'paLimit'){

	     	 /**
		      * SAVE INFO IN THE DATABASE
		      */
	          $.ajax({
	          	url : 'api/store.php',
	          	async : false,
	          	type : 'post',
	          	data : {
	          		minutes : litem.minutesPassed,
	          		totaliNeLek : litem.totaliNeLek,
	          		leva : litem.leva,
	          		openType : 'paLimit',
	          		playstation_num : 1,
	          		pc_start_time : litem.startTime,
	          	},
	          	success : function(data){
	          		var data = JSON.parse(data);

	          		if (data.status == 'OK') {
	          			generateSuccessAlert(' DATA IS SAVED IN DB');
	          		}else if(data.status == 'ERROR'){
	          			generateDangerAlert(' ERROR SAVING DATA TO DATABASE ');
	          		}else{
	          			generateDangerAlert(' ERROR SAVING DATA TO DATABASE ');
	          		}
	          	},
	          	error : function(msg){
	          		alert(msg);
	          	}
	          });


			pc1.stop();	
			clearStartTime();
			clearEndTime();
			clearTime();
			clearTotaliNeLek();
			localStorage.removeItem("pc1");
			turnOffPc(1);


	     }
	 
	     



	  });





	  /**
	  * UTILITY FUNCTIONS -----------------------------------------------------------------------------------------------
	  */


	 function errorAlert(){
        //GENERATE DANGER ALERT and return 0 to stop function from executing any further
         alert('Gabim ne forme');
         return 0;
     }

    function validateForm(){

	    /**
	    * MAR OPSIONIN E ZGJEDHR ME LIMIT OSE PALIMIT
	    */
	    var OpenTime  = $('input[name="pc1opentime"]:checked').val();
	    var levaValue  = $('input[name="pc1leva"]:checked').val();
	    var lek = $('#pc1lek').val();
	    var min = $('#pc1min').val();

	    var minutes = 0;
	    var totaliNeLek = 0;

	    


	    if (OpenTime == 'meLimit') {

	      /**
	      * ME LIMIT
	      * variables minutes and  totali ne lek will be sended on backend
	      */
	    
	      if (lek!= '') {
	      	  /**
	      	  * GJEJ NE SA MINUTA  CONVERTOHEN LEKET
	      	  */
	          minutes = lek_to_minutes(lek , levaValue );
	          totaliNeLek = lek;

	      }else if(min != ''){

	      	  /**
	      	  * GJEJ  NE SA LEK KONVERTOHEN MINUTAT QE DO RIJ
	      	  */
	          minutes = Math.round(parseInt(min));
	          totaliNeLek =  minutes_to_lek(minutes , levaValue)

	      }else{
	          //GENERATE DANGER ALERT and return 0 to stop function from executing any further
	          alert('Gabim ne forme');
	          return 0;
	      }


	      /**
	      * SAVE INFO IN THE DATABASE
	      */
          $.ajax({
          	url : 'api/store.php',
          	async : false,
          	type : 'post',
          	data : {
          		minutes : minutes,
          		totaliNeLek : totaliNeLek,
          		leva : levaValue,
          		openType : 'meLimit',
          		playstation_num : 1,
          	},
          	success : function(data){
          		var data = JSON.parse(data);

          		if (data.status == 'OK') {
          			generateSuccessAlert(' DEVICE IS OPENED ');
          		}else if(data.status == 'ERROR'){
          			generateDangerAlert(' ERROR SAVING DATA TO DATABASE ');
          		}else{
          			generateDangerAlert(' ERROR SAVING DATA TO DATABASE ');
          		}
          	},
          	error : function(msg){
          		alert(msg);
          	}
          });

 

          /**
          * TURN ON THE PC
          */

          turnOnPc(1);
 			

	      /**
	      * START THE TIMER
	      */
	      startTimer(pc1 , true , minutes);

	      //SET START END TIME
	      var start_time = setStartTime();
	      var end_time = setEndTime(minutes);
	      setTotaliNeLek(totaliNeLek);

	      /**
	      * SAVE ON LOCALSTORAGE
	      */
	      localStorage.setItem("pc1", JSON.stringify({
	         	openType : 'meLimit',
	         	leva : levaValue,
	         	startTime : start_time,
	         	endTime   : end_time,
	         	totaliNeLek : totaliNeLek,
	         	remainingMinutes : 0,
	         	minutesPassed : 0 
          }));

	     

	     $('#pc1Time').html(pc1.getTimeValues().toString());

	     bindSecondsUpdatedEventHandler(pc1 , levaValue , true );


	     pc1.addEventListener('targetAchieved', function (e) {

	       clearStartTime();
	       clearEndTime();
	       clearTime();
	       clearTotaliNeLek();
	       localStorage.removeItem("pc1");


	       /**
	       * TURN OFF THE PC
	       */
	       turnOffPc(1);
	       

	     });



	    }else{

	      /**
	      * PA LIMIT
	      */

	      //TIMER NEEDS TO BE DESTROYED AND RE INSTANSIATED AGAIN 
	      instantiateTimer();


	      /**
	      * START THE TIMER
	      */
	      
	      startTimer(pc1 , false , 0);


	      //SET START  TIME
	      var start_time = setStartTime();

	      /**
	      * SAVE ON LOCALSTORAGE
	      */
	      localStorage.setItem("pc1", JSON.stringify({
	         	openType : 'paLimit',
	         	leva : levaValue,
	         	startTime : start_time,
	         	endTime   : '',
	         	totaliNeLek : 0,
	         	remainingMinutes : 0,
	         	minutesPassed : 0 
          }));


	      $('#pc1Time').html(pc1.getTimeValues().toString());


	      bindSecondsUpdatedEventHandler(pc1 , levaValue , false );

	     /**
	      * Turn on 
	      */
	      turnOnPc(1);

	    }


    }//END FUNC



    function setStartTime(){
     	var current_time = new moment ().format("HH:mm:ss");
     	$('#pc1StartTime').html(current_time);
     	return current_time;
    }

    function setEndTime(minutes){
 
     	var current_time = new moment ();
     	var end_time = current_time.add( minutes , 'm' );
     	$('#pc1EndTime').html(end_time.format("HH:mm:ss"));
     	return end_time.format("HH:mm:ss");
    }

    function setTotaliNeLek(lek){
     	$('#pc1TotalLek').html(lek + 'LEK');
     	return 1;
    }



    function clearStartTime(){
     	$('#pc1StartTime').html('-');
    }

     function clearEndTime(){
     	$('#pc1EndTime').html('-');
     }

     function clearTotaliNeLek(){
     	$('#pc1TotalLek').html('-');
     }

     function clearTime(){
     	 $('#pc1Time').html('-');
     }


    function generateDangerAlert(error = ''){
     	var alertHtml = `<div class="alert alert-danger" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  `+error+`
			</div>`;
		$('body').append(alertHtml);
		window.setTimeout(function(){
			$('.alert-danger').remove();
		}, 3000);

     }


    function generateSuccessAlert(error = ''){
     	var alertHtml = `<div class="alert alert-success" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  `+error+`
			</div>`;
		$('body').append(alertHtml);
		window.setTimeout(function(){
			$('.alert-success').remove();
		}, 3000);

     }


    function startTimer(pc , countdown , minutes){
    	pc.start({countdown: countdown, startValues: {minutes: minutes}});
    }

    function minutes_to_lek(minutes , levaValue){
	     var totaliNeLek = 0;

         if (levaValue == 2) {
              totaliNeLek = Math.round( (twormcontoller * minutes) / 60 ) ;
         }else if(levaValue == 3){
             totaliNeLek = Math.round( (thrermcontoller * minutes) / 60 ) ;
         }else if(levaValue == 4){
             totaliNeLek = Math.round( (fourrmcontoller * minutes) / 60 ) ;
         }else{
            errorAlert();
         }

         setTotaliNeLek(totaliNeLek);

         return totaliNeLek;
    }
   	
   	function lek_to_minutes(lek , levaValue ){
   		  var minutes = 0;

		  if (levaValue == 2) {
	        minutes = Math.round( ((parseInt(lek) *60) / twormcontoller) );
	      }else if(levaValue == 3){
	        minutes = Math.round( ((parseInt(lek) *60) / thrermcontoller) );
	      }else if(levaValue == 4){
	        minutes = Math.round( ((parseInt(lek) *60) / fourrmcontoller) );
	      }else{
	        errorAlert();
	      }

	      return minutes;
   	}


   	function bindSecondsUpdatedEventHandler(pc1 , levaValue , limit ){
   		 if (limit) {
   		 		/**
   		 		* ME LIMIT
   		 		*/
	   		   pc1.addEventListener('secondsUpdated', function (e) {
		         $('#pc1Time').html(pc1.getTimeValues().toString());

		         /**
		         * LLOGARIS TOTALIN NE LEK
		         */
		         var time = moment( pc1.getTimeValues().toString()  , "HH:mm:ss" );
		         var hours = time.hours();
		         var minutes = time.minutes();
		         if (hours != 0) {
		         	minutes = minutes + (60 * hours);
		         };

		         minutes_to_lek(minutes , levaValue);

		         /**
		         * UPDATE THE LOCALSTORAGE
		         */
		         var litem = JSON.parse(localStorage.getItem("pc1"));
		         litem.remainingMinutes = minutes;
		         localStorage.setItem('pc1' , JSON.stringify(litem));

		       });

   		 }else{
   		 	    /**
   		 		* PA LIMIT
   		 		*/
	   		   pc1.addEventListener('secondsUpdated', function (e) {
		         $('#pc1Time').html(pc1.getTimeValues().toString());

		         /**
		         * LLOGARIS TOTALIN NE LEK
		         */
		         var time = moment( pc1.getTimeValues().toString()  , "HH:mm:ss" );
		         var hours = time.hours();
		         var minutes = time.minutes();
		         if (hours != 0) {
		         	minutes = minutes + (60 * hours);
		         };

		         var totaliNeLek =  minutes_to_lek(minutes , levaValue);

		         /**
		         * UPDATE THE LOCALSTORAGE
		         */
		         var litem = JSON.parse(localStorage.getItem("pc1"));
		         litem.minutesPassed = minutes;
		         litem.totaliNeLek = totaliNeLek;
		         localStorage.setItem('pc1' , JSON.stringify(litem));

		      });
   		 }
   		
   	}

   	function instantiateTimer(){
   		pc1 = new Timer();
   	}
   	function destroyTimer(){
   		pc1 = null;
   	}

   	function turnOnPc(pc = 0){
   		if (pc == 0) { return 0;};

   		var url = 'relay'+pc+'on.php';

   		$.ajax({
   			url : 'api/KMTronic_RelayLib_8_PHP/'+url,
   			success : function(data){
   				if (data.status == 'OK') {
   					generateSuccessAlert(data.mesagge);
   				};
   			},	
   			error : function(e){
   				alert(e);
   			}

   		});
   	};


   	function turnOffPc(pc = 0){
   		if (pc == 0) { return 0;};

   		var url = 'relay'+pc+'off.php';
   		
   		$.ajax({
   			url : 'api/KMTronic_RelayLib_8_PHP/'+url,
   			success : function(data){
   				if (data.status == 'OK') {
   					generateSuccessAlert(data.mesagge);
   				};
   			},	
   			error : function(e){
   				alert(e);
   			}

   		});
   	};



})();