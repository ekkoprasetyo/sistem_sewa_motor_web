const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

function my_Clock(srv_clock)
{
    this.cur_date = new Date(srv_clock);
    this.year = this.cur_date.getFullYear();
    this.month = this.cur_date.getMonth();
    this.date = this.cur_date.getDate();
    this.hours = this.cur_date.getHours();
    this.minutes = this.cur_date.getMinutes();
    this.seconds = this.cur_date.getSeconds();
}

function pad(d) {
    return (d < 10) ? '0' + d.toString() : d.toString();
}

my_Clock.prototype.run = function ()
{
    setInterval(this.update.bind(this), 1000);
};
my_Clock.prototype.update = function ()
{
    this.updateTime(1);
    $('#clock').html(this.date + " " + monthNames[this.month] + ", " + this.year + " <b style='color: #ff9829'>" + pad(this.hours) + ":" + pad(this.minutes) + ":" + pad(this.seconds) + "</b>");
};
my_Clock.prototype.updateTime = function (secs)
{
    this.seconds+= secs;
    if (this.seconds >= 60)
    {
        this.minutes++;
        this.seconds= 0;
    }
    if (this.minutes >= 60)
    {
        this.hours++;
        this.minutes=0;
    }
    if (this.hours >= 24)
    {
        this.hours = 0;
        this.date++;
    }
};