<a class="fancyimage" rel="group">
    <img alt=""
         src="https://img.freepik.com/free-photo/a-cupcake-with-a-strawberry-on-top-and-a-strawberry-on-the-top_1340-35087.jpg"
         class="img-thumbnail"/>
</a>
<a class="fancyimage" rel="group" href="{{route('surveys.show', $survey->id)}}">
    {{ $survey->title }}
</a>
<h2>
    {{ $survey->description }}
</h2>
