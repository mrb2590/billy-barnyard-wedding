<x-mail::message>
# We have received your RSVP
<br>
<p>
@if($guest->is_attending)
Thank you for your response and get ready to party! We cannot wait to see you at our wedding!
@else
Thank you for your response. We are sad you will not be able to make it to our wedding, but we do hope to see you soon!
@endif
</p
@if($guest->is_attending_rehearsal)
<br>
<br>
<h3 style="text-align: center; margin-bottom: 6px;">Welcome Dinner</h3>
<p style="text-align: center;">
7:00PM <br>
September 15, 2023 <br>
165 Hardvard Avenue, Rockville Centre, New York
</p>
@endif
@if($guest->is_attending)
<br>
<br>
<h3 style="text-align: center; margin-bottom: 6px;">Reception</h3>
<p style="text-align: center;">
2:00PM <br>
September 16, 2023 <br>
165 Hardvard Avenue, Rockville Centre, New York
</p>
@endif
<br>
<br>
<p>
Sincerely,<br>
Alexandra & Michael
</p>
</x-mail::message>
