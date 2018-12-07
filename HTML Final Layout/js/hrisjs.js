<script>

	var app = angular.module('myApp', []);
	app.controller('myCtrl', function ($scope) {
		$scope.plus = true;
		$scope.plusone = true;
		$scope.plustwo = true;
		$scope.ShowSearch = false;
		$scope.showInfo = true;
		
		
		$scope.showInformation = function(){
				$scope.showInfo = !($scope.showInfo);
				
				var centerDiv =document.getElementById('centerDiv');
				if($scope.showInfo ){
					centerDiv.style.width = '83.3%';
				}
				else{
					centerDiv.style.width = '100%';
				}
		}
	});
	
	
	/*Search box starts here*/
	  $(document).ready(function(){
            var submitIcon = $('.searchbox-icon');
            var inputBox = $('.searchbox-input');
            var searchBox = $('.searchbox');
            var isOpen = false;
            submitIcon.click(function(){
                if(isOpen == false){
                    searchBox.addClass('searchbox-open');
                    inputBox.focus();
                    isOpen = true;
                } else {
                    searchBox.removeClass('searchbox-open');
                    inputBox.focusout();
                    isOpen = false;
                }
            });  
             submitIcon.mouseup(function(){
                    return false;
                });
            searchBox.mouseup(function(){
                    return false;
                });
            $(document).mouseup(function(){
                    if(isOpen == true){
                        $('.searchbox-icon').css('display','block');
                        submitIcon.click();
                    }
                });
        });
            function buttonUp(){
                var inputVal = $('.searchbox-input').val();
                inputVal = $.trim(inputVal).length;
                if( inputVal !== 0){
                    $('.searchbox-icon').css('display','none');
                } else {
                    $('.searchbox-input').val('');
                    $('.searchbox-icon').css('display','block');
                }
            }
	/*Search box ends here*/
</script>