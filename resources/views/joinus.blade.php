<div style="boxShadow :1px 1px 10px #ccc;padding :20px; position:relative">
    <div className='display:flex; align-items:center;'>
        <img width={100} src={{ $image }} />

        <div className='margin:0px 10px'>
            <h3>{{ $full_name }}</h3>
            <h6>{{ $my_email }}</h6>
            <h6>{{ $phone }}</h6>

            <h6>{{ $linked_in }}</h6>
        </div>
    </div>
    <div>

        <p>
            {!! $about !!}
        </p>


    </div>
</div>
