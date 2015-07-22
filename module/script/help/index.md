### Introduce
Goose 프로그램 라이브러리를 이용하여 어떤 기능을 실행하는 스크립트 관리 모듈입니다.  
간단하게 어떤 데모 프로그램을 만들어서 테스트해보거나 데이터베이스를 수정하는 스크립트를 만들어 일회성으로 사용할 수 있습니다.


### setting.json
모듈의 환경설정 파일입니다. 설정에 대한 소개는 다음과 같습니다.

* __name__  
모듈의 id값

* __title__  
출력되는 제목값

* __description__  
모듈의 설명

* __permission__  
접근권한 번호

* __adminPermission__  
모듈 관리자 권한 번호 (숫자가 높을수록 권한이 높습니다.)

* __skin__  
다른형태로 목록이나 폼 페이지가 출력되는 스킨값


### Make script
실행할 스크립트를 만들어 보겠습니다.

1. `{goose}/module/script/` 로 이동합니다. 스크립트 모듈파일이 있는 장소입니다.
1. __run__ 이름의 폴더가 보이는데 거기로 들어가서 원하는 이름으로 폴더를 만듭니다.
1. `meta.json`, `run.php` 두개의 파일이 필요합니다. 우선 meta.json 파일을 만들고 다음과 같이 어떤용도로 사용하는 스크립트인지 제목과 설명을 넣어줍니다.
```
{
	"name" : "Hello world",
	"description" : "헬로우월드 문자를 출력하는 샘플코드입니다."
}
```
1. 이번에는 run.php 파일을 만들고 코드를 작성합니다.  
goose 라이브러리를 이용하여 원하는대로 코드를 작성합니다. 테스트를 위하여 'hello world' 이름의 제목과 구구단 3단을 출력하는 코드를 작성하겠습니다.  
```
<?php
echo "<h1>Hello world<h1>";
for ($i=1; $i<10; $i++)
{
	echo '3 X '.$i.' = '.(3*$i) . '<br/>';
}
```


### Run script
이전 섹션에서 만들었던 스크립트를 실행해보겠습니다.

1. `{goose}/script/`로 이동하면 스크립트의 목록을 확인할 수 있습니다.  
1. meta.json 파일을 만들때 이름과 설명이 script 목록에서 뜨는것을 확인할 수 있습니다.
1. 설명 아래에 실행하기 버튼을 누르면 페이지가 이동하면서 run.php 파일의 코드가 실행되는것을 확인할 수 있는 메세지들을 확인 할 수 있습니다.