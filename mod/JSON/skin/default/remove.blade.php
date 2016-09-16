@extends($layout->skinAddr.'.layout')


@section('content')
<section>
	@include($layout->skinAddr.'.heading', [
		'title' => $mod->set['title'] . ' ' . $typeName,
		'description' => $mod->set['description'],
		'isHeadNavigation' => true
	])

	<form action="{{ $root }}/{{ $mod->name }}/{{ $action }}/" method="post" name="post" id="regsterForm">
		<input type="hidden" name="json_srl" value="{{ $repo->json['srl'] }}">

		<fieldset class="form-group">
			<p class="message"><em class="gs-brk-quot">{{ $repo->json['name'] }}</em> JSON 데이터를 삭제하시겠습니까? 삭제된 JSON 데이터는 복구할 수 없습니다.</p>
		</fieldset>

		<nav class="gs-btn-group right">
			<button type="submit" class="gs-button col-key">삭제하기</button>
			<button type="button" class="gs-button" onclick="history.back(-1)">돌아가기</button>
		</nav>
	</form>
</section>
@endsection