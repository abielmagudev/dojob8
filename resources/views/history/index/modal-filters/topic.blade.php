<div class="mb-3">
    <label for="topicSelect" class="form-label">Topic</label>
    <select id="topicSelect" class="form-select" name="topic">
        <option selected label="- Any topic -"></option>

        @foreach($topics as $topic)
        <option value="{{ $topic }}" {{ isSelected($topic == $request->get('topic')) }}>{{ ucfirst($topic) }}</option>
        @endforeach
    </select>
</div>
