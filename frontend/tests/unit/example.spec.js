import { shallowMount } from '@vue/test-utils';
import TransactionsView from '@/views/TransactionsView.vue';

describe('TransactionsView.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message';
    const wrapper = shallowMount(TransactionsView, {
      propsData: { msg },
    });
    expect(wrapper.text()).toMatch(msg);
  });
});
